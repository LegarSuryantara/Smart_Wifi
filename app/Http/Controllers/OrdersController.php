<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Pakets;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Transaction;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Exception;

class OrdersController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'name'     => 'required',
            'address'  => 'required',
            'phone'    => 'required',
            'qty'      => 'required|integer|min:1'
        ]);

        $paket = Pakets::findOrFail($request->paket_id);

        // Generate unique order_id
        $uniqueOrderId = 'ORDER-' . now()->format('YmdHis') . '-' . Str::random(10);

        // Hitung total harga
        $gross_amount = $request->qty * $paket->harga;

        // Buat data order
        $orderData = [
            'paket_id'           => $request->paket_id,
            'name'               => $request->name,
            'address'            => $request->address,
            'phone'              => $request->phone,
            'qty'                => $request->qty,
            'gross_amount'       => $gross_amount,
            'transaction_status' => 'unpaid', // ✅ pakai transaction_status
            'midtrans_order_id'  => $uniqueOrderId
        ];

        $order = Orders::create($orderData);

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;

        $params = [
            'transaction_details' => [
                'order_id'      => $uniqueOrderId,
                'gross_amount'  => $gross_amount,
            ],
            'customer_details' => [
                'first_name'    => $request->name,
                'last_name'     => '',
                'phone'         => $request->phone,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('admin.pakets.checkout', compact('snapToken', 'order', 'paket'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed    = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Orders::where('midtrans_order_id', $request->order_id)->first();

            if ($order) {
                $vaBank   = null;
                $vaNumber = null;

                // Jika metode pembayaran bank transfer (VA)
                if (isset($request->va_numbers[0])) {
                    $vaBank   = $request->va_numbers[0]['bank'];
                    $vaNumber = $request->va_numbers[0]['va_number'];
                }

                $order->update([
                    'transaction_id'     => $request->transaction_id,
                    'transaction_status' => $request->transaction_status,
                    'payment_type'       => $request->payment_type,
                    'gross_amount'       => $request->gross_amount,
                    'fraud_status'       => $request->fraud_status ?? null,
                    'va_bank'            => $vaBank,
                    'va_number'          => $vaNumber,
                    'ewallet_type'       => $request->payment_type === 'qris' ? 'gopay/shopeepay' : null,
                    'bill_key'           => $request->bill_key ?? null,
                    'biller_code'        => $request->biller_code ?? null,
                ]);
            }
        }
    }

    public function detailTransaction($orderId)
    {
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);

        $status = Transaction::status($orderId);
        dd($status);
    }

    public function syncTransaction($id): RedirectResponse
    {
        $order = Orders::findOrFail($id);

        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);

        try {
            $status = Transaction::status($order->midtrans_order_id);

            $transactionStatus = is_object($status)
                ? $status->transaction_status
                : ($status['transaction_status'] ?? null);

            if ($transactionStatus) {
                $order->update([
                    'transaction_status' => $transactionStatus
                ]);

                return redirect()->back()->with('success', 'Status transaksi diperbarui dari Midtrans!');
            } else {
                return redirect()->back()->with('warning', 'Transaksi ada di database tapi Midtrans tidak balas status.');
            }
        } catch (Exception $e) {
            // Kalau Midtrans kasih 404
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan di Midtrans (mungkin expired atau salah env).');
        }
    }

    public function transactions(Request $request)
    {
        $query = Orders::query();

        // 1. Filter Tanggal Mulai (start_date)
        if ($request->filled('start_date')) {
            // Filter: created_at >= start_date (tanggal awal hari)
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        // 2. Filter Tanggal Akhir (end_date)
        if ($request->filled('end_date')) {
            // Filter: created_at <= end_date (akhir hari, inklusif)
            // Menggunakan Carbon untuk mendapatkan akhir hari (23:59:59)
            $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
            $query->where('created_at', '<=', $endDate);
        }

        // Ambil data yang sudah difilter, diurutkan, dan dipaginasi
        $transactions = $query->latest()->paginate(10);

        // Memastikan parameter filter tetap ada saat navigasi halaman
        $transactions->appends($request->query());
        return view('admin.transactions.index', compact('transactions'));
    }

    public function exportPdf(Request $request)
    {
        $query = Orders::query();

        // Logika Filter Tanggal (Sama seperti di transactions())
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $endDate = \Carbon\Carbon::parse($request->end_date)->endOfDay();
            $query->where('created_at', '<=', $endDate);
        }
        // Ambil semua data transaksi yang sudah difilter tanpa pagination
        $transactions = $query->latest()->get();
        try {
            // Ambil semua transaksi, bisa tambahkan relasi jika perlu
            $transactions = Orders::with('paket')->latest()->get();

            // Load view PDF transaksi
            $pdf = Pdf::loadView('admin.transactions.pdf', [
                'transactions' => $transactions
            ]);

            // Tampilkan di browser
            return $pdf->stream('transaksi-' . date('Ymd-His') . '.pdf');
        } catch (\Exception $e) {
            return redirect()->route('transactions')
                ->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }
}

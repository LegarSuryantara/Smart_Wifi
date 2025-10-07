<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Pakets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Transaction;
use Illuminate\Http\RedirectResponse;
use Exception;

class OrdersController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'qty'      => 'required|integer|min:1'
        ]);

        // Pastikan user login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }
        $user->user_id = Auth::id();
        $paket = Pakets::findOrFail($request->paket_id);

        // Generate unique order_id
        $uniqueOrderId = 'ORDER-' . now()->format('YmdHis') . '-' . Str::random(10);

        // Hitung total harga
        $gross_amount = $request->qty * $paket->harga;

        // Buat data order
        $order = Orders::create([
            'user_id'             => $user->id,
            'paket_id'            => $request->paket_id,
            'qty'                 => $request->qty,
            'gross_amount'        => $gross_amount,
            'transaction_status'  => 'unpaid',
            'midtrans_order_id'   => $uniqueOrderId,
        ]);

        // Parameter transaksi Midtrans (pakai data dari tabel users)
        $params = [
            'transaction_details' => [
                'order_id'     => $uniqueOrderId,
                'gross_amount' => $gross_amount,
            ],
            'customer_details' => [
                'first_name'   => $user->name,
                'last_name'    => '',
                'email'        => $user->email,
                'phone'        => $user->phone,
                'billing_address' => [
                    'address' => $user->address,
                ],
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

    public function syncTransaction($id): RedirectResponse
    {
        $order = Orders::findOrFail($id);

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
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan di Midtrans (mungkin expired atau salah env).');
        }
    }

    public function notificationHandler(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $orderId           = $notif->order_id;

        $order = Orders::where('midtrans_order_id', $orderId)->first();

        if ($order) {
            $order->update([
                'transaction_status' => $transactionStatus
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function markActivated($id)
    {
        $order = Orders::findOrFail($id);
        $order->update(['is_activated' => 'yes']);

        return redirect()->back()->with('success', 'Paket telah diaktifkan di Mikrotik dan ditandai selesai.');
    }

    public function transactions()
    {
        $transactions = Orders::latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }
}

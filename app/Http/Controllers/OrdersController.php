<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Pakets;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
public function checkout(Request $request)
    {
        $request->validate([
            'paket_id' => 'required|exists:pakets,id',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'qty' => 'required|integer|min:1'
        ]);

        $paket = Pakets::findOrFail($request->paket_id);
        
        // Generate unique order_id
        $uniqueOrderId = 'ORDER-' . now()->format('YmdHis') . '-' . Str::random(10);
        
        // Hitung total harga
        $totalPrice = $request->qty * $paket->harga;
        
        // Buat data order dengan struktur yang jelas
        $orderData = [
            'paket_id' => $request->paket_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'qty' => $request->qty,
            'total_price' => $totalPrice, // Pastikan ini ada
            'status' => 'Unpaid', // Gunakan huruf kapital pertama
            'midtrans_order_id' => $uniqueOrderId
        ];
        
        $order = Orders::create($orderData);

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $uniqueOrderId,
                'gross_amount' => $totalPrice, // Gunakan variabel $totalPrice
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'last_name' => '',
                'phone' => $request->phone,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('admin.pakets.checkout', compact('snapToken', 'order', 'paket'));
    }

    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement'){
                // Cari order berdasarkan midtrans_order_id (bukan ID biasa)
                $order = Orders::where('midtrans_order_id', $request->order_id)->first();
                if($order) {
                    $order->update(['status' => 'Paid']);
                }
            }
        }
    }
}
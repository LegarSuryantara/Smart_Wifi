<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Pakets;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function checkout(Request $request)
    {
        $paket = Pakets::find($request->paket_id);
        $request->request->add(['total_price' => $request->qty * 100000, 'status' => 'unpaid']);
        $order = Orders::Create($request->all());


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $request->name,
                'last_name' => '',
                'phone' => $request->phone,
            ),
        );


        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('admin.pakets.checkout', compact('snapToken', 'order', 'paket'));
    }

    public function callback(Request $request){
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement'){
                $order = Orders::find($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }
}

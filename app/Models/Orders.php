<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'paket_id', 
        'name',
        'address',
        'phone',
        'qty',
        'trasnstatus',
        'midtrans_order_id',
        'transaction_id',
        'payment_type',
        'transaction_status',
        'fraud_status',
        'gross_amount',
        'va_bank',
        'va_number',
        'ewallet_type',
        'bill_key',
        'biller_code',
    ];

    public function paket(){
        return $this->belongsTo(Pakets::class);
    }
}

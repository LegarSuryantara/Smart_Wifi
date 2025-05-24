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
        'total_price',
        'status',
        'midtrans_order_id'
    ];

    public function paket(){
        return $this->belongsTo(Pakets::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakets extends Model
{
    use HasFactory;

    protected $table = 'pakets';

    protected $fillable = [
        'nama_paket', 
        'kategori', 
        'harga', 
        'kecepatan'
    ];
}

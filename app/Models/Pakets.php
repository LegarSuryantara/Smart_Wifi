<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakets extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'kategori',
        'harga',
        'kecepatan'
    ];

    public function orders(){
        return $this->hasMany(Orders::class);
    }
}

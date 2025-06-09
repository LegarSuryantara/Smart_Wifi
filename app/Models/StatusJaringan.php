<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusJaringan extends Model
{
    use HasFactory;

    protected $table = 'statusjaringans';

    protected $fillable = [
        'tanggal', 'status', 'uptime', 'downtime', 'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'uptime' => 'datetime:H:i:s',
        'downtime' => 'datetime:H:i:s',
    ];
}

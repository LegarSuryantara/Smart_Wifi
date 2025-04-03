<?php

namespace Database\Seeders;

use App\Models\Pakets;
use Illuminate\Database\Seeder;

class PaketSeeder extends Seeder
{
    public function run()
    {
        $pakets = [
            [
                'nama_paket' => 'Paket Dasar',
                'kategori' => 'Dasar',
                'harga' => 100000,
                'kecepatan' => '10 Mbps'
            ],
            [
                'nama_paket' => 'Paket Reguler',
                'kategori' => 'Reguler',
                'harga' => 150000,
                'kecepatan' => '20 Mbps'
            ],
            [
                'nama_paket' => 'Paket Bisnis',
                'kategori' => 'Bisnis',
                'harga' => 200000,
                'kecepatan' => '40 Mbps'
            ],
            [
                'nama_paket' => 'Paket Eksekutif',
                'kategori' => 'Eksekutif',
                'harga' => 250000,
                'kecepatan' => '80 Mbps'
            ],
            [
                'nama_paket' => 'Paket Premium',
                'kategori' => 'Eksekutif',
                'harga' => 350000,
                'kecepatan' => '100 Mbps'
            ]
        ];

        foreach ($pakets as $paket) {
            Pakets::firstOrCreate(
                ['nama_paket' => $paket['nama_paket']],
                $paket
            );
        }

        $this->command->info('Successfully created '.count($pakets).' internet packages!');
    }
}
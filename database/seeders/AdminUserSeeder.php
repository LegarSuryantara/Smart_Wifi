<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat user admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@wifi.com'],
            [
                'name' => 'Administrator',
                'phone' => '081234567890', // Nomor HP default
                'address' => 'Jl. Admin No. 1, Kota Administrasi', // Alamat default
                'password' => Hash::make('administrator_defaults11890'), // Password default
                'email_verified_at' => now()
            ]
        );

        // 2. Pastikan role admin sudah ada
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $userRole = Role::firstOrCreate([
            'name' => 'user', 
            'guard_name' => 'web'
        ]);

        // 3. Assign role ke user
        $admin->assignRole($adminRole, $userRole);

        $this->command->info('Default admin user created!');
        $this->command->warn('Email: admin@wifi.com');
        $this->command->warn('Password: administrator_defaults11890');
        $this->command->warn('Nomor HP: 081234567890');
        $this->command->warn('Alamat: Jl. Admin No. 1, Kota Administrasi');
    }
}
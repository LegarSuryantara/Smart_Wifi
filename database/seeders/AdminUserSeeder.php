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
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // User admin utama
        $admin = User::firstOrCreate(
            ['email' => 'admin@wifi.com'],
            [
                'name' => 'Administrator',
                'phone' => '081234567890',
                'address' => 'Jl. Admin No. 1, Kota Administrasi',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now()
            ]
        );
        $admin->assignRole($adminRole);

        // admin 1
        $admin1 = User::firstOrCreate(
            ['email' => 'admin1@wifi.com'],
            [
                'name' => 'Admin Satu',
                'phone' => '081234567891',
                'address' => 'Jl. Admin No. 2, Kota Administrasi',
                'password' => Hash::make('admin1@wifi.com'),
                'email_verified_at' => now()
            ]
        );
        $admin1->assignRole($adminRole);

        // admin 2
        $admin2 = User::firstOrCreate(
            ['email' => 'admin2@wifi.com'],
            [
                'name' => 'Admin Dua',
                'phone' => '081234567892',
                'address' => 'Jl. Admin No. 3, Kota Administrasi',
                'password' => Hash::make('admin2@wifi.com'),
                'email_verified_at' => now()
            ]
        );
        $admin2->assignRole($adminRole);

        // admin 3
        $admin3 = User::firstOrCreate(
            ['email' => 'admin3@wifi.com'],
            [
                'name' => 'Admin Tiga',
                'phone' => '081234567893',
                'address' => 'Jl. Admin No. 4, Kota Administrasi',
                'password' => Hash::make('admin3@wifi.com'),
                'email_verified_at' => now()
            ]
        );
        $admin3->assignRole($adminRole);

        $this->command->info('============================================');
        $this->command->info('ADMIN ACCOUNTS CREATED SUCCESSFULLY');
        $this->command->info('============================================');
        
        $this->command->warn('MAIN ADMIN ACCOUNT:');
        $this->command->info('Name: Administrator');
        $this->command->warn('Email: admin@wifi.com');
        $this->command->warn('Password: 12345678');
        $this->command->warn('Phone: 081234567890');
        $this->command->warn('Address: Jl. Admin No. 1, Kota Administrasi');
        $this->command->info('--------------------------------------------');
        
        $this->command->warn('ADMIN 1 ACCOUNT:');
        $this->command->info('Name: Admin Satu');
        $this->command->warn('Email: admin1@wifi.com');
        $this->command->warn('Password: admin1@wifi.com');
        $this->command->warn('Phone: 081234567891');
        $this->command->warn('Address: Jl. Admin No. 2, Kota Administrasi');
        $this->command->info('--------------------------------------------');
        
        $this->command->warn('ADMIN 2 ACCOUNT:');
        $this->command->info('Name: Admin Dua');
        $this->command->warn('Email: admin2@wifi.com');
        $this->command->warn('Password: admin2@wifi.com');
        $this->command->warn('Phone: 081234567892');
        $this->command->warn('Address: Jl. Admin No. 3, Kota Administrasi');
        $this->command->info('--------------------------------------------');
        
        $this->command->warn('ADMIN 3 ACCOUNT:');
        $this->command->info('Name: Admin Tiga');
        $this->command->warn('Email: admin3@wifi.com');
        $this->command->warn('Password: admin3@wifi.com');
        $this->command->warn('Phone: 081234567893');
        $this->command->warn('Address: Jl. Admin No. 4, Kota Administrasi');
        $this->command->info('============================================');
        
        $this->command->warn('NOTE: All accounts have been assigned the "admin" role');
        $this->command->warn('All email verification dates have been set to current time');
    }
}
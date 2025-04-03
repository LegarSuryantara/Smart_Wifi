<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Create regular user
        $user = User::firstOrCreate(
            ['email' => 'user@wifi.com'],
            [
                'name' => 'Regular User',
                'phone' => '081234567891', // Different phone number
                'address' => 'Jl. User No. 1, Kota User', 
                'password' => Hash::make('user_default_password123'), 
                'email_verified_at' => now()
            ]
        );

        // 2. Get the user role (assuming it exists from RoleSeeder)
        $userRole = Role::where('name', 'user')->first();

        // 3. Assign role if found
        if ($userRole) {
            $user->assignRole($userRole);
        }

        $this->command->warn('Role: USER');
        $this->command->info('Regular user created!');
        $this->command->warn('Email: user@wifi.com');
        $this->command->warn('Password: user_default_password123');
        $this->command->warn('Phone: 081234567891');
        $this->command->warn('Address: Jl. User No. 1, Kota User');
    }
}
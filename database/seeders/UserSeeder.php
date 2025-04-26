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
        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        $user1 = User::firstOrCreate(
            ['email' => 'user@wifi.com'],
            [
                'name' => 'Regular User',
                'phone' => '081234567881',
                'address' => 'Jl. User No. 1, Kota User', 
                'password' => Hash::make('user_default'), 
                'email_verified_at' => now()
            ]
        );
        $user1->assignRole($userRole);

        $user2 = User::firstOrCreate(
            ['email' => 'user2@wifi.com'],
            [
                'name' => 'Second User',
                'phone' => '081234567882',
                'address' => 'Jl. User No. 2, Kota User',
                'password' => Hash::make('user2@wifi.com'),
                'email_verified_at' => now()
            ]
        );
        $user2->assignRole($userRole);

        $user3 = User::firstOrCreate(
            ['email' => 'user3@wifi.com'],
            [
                'name' => 'Third User',
                'phone' => '081234567883',
                'address' => 'Jl. User No. 3, Kota User',
                'password' => Hash::make('user3@wifi.com'),
                'email_verified_at' => now()
            ]
        );
        $user3->assignRole($userRole);

        $this->command->info('============================================');
        $this->command->info('REGULAR USER ACCOUNTS CREATED SUCCESSFULLY');
        $this->command->info('============================================');
        
        $this->command->warn('USER 1 ACCOUNT:');
        $this->command->info('Name: Regular User');
        $this->command->warn('Email: user@wifi.com');
        $this->command->warn('Password: user_default');
        $this->command->warn('Phone: 081234567891');
        $this->command->warn('Address: Jl. User No. 1, Kota User');
        $this->command->info('--------------------------------------------');
        
        $this->command->warn('USER 2 ACCOUNT:');
        $this->command->info('Name: Second User');
        $this->command->warn('Email: user2@wifi.com');
        $this->command->warn('Password: user2@wifi.com');
        $this->command->warn('Phone: 081234567892');
        $this->command->warn('Address: Jl. User No. 2, Kota User');
        $this->command->info('--------------------------------------------');
        
        $this->command->warn('USER 3 ACCOUNT:');
        $this->command->info('Name: Third User');
        $this->command->warn('Email: user3@wifi.com');
        $this->command->warn('Password: user3@wifi.com');
        $this->command->warn('Phone: 081234567893');
        $this->command->warn('Address: Jl. User No. 3, Kota User');
        $this->command->info('============================================');
        
        $this->command->warn('NOTE: All accounts have been assigned the "user" role');
        $this->command->warn('All email verification dates have been set to current time');
    }
}
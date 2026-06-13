<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Account
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@jinggarent.com'],
            [
                'name' => 'Admin JinggaRent',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'phone' => '08111111111',
                'address' => 'Kantor Pusat JinggaRent',
            ]
        );

        // Customer Account
        \App\Models\User::updateOrCreate(
            ['email' => 'user@jinggarent.com'],
            [
                'name' => 'Customer JinggaRent',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'customer',
                'is_active' => true,
                'phone' => '08222222222',
                'address' => 'Rumah Pelanggan',
            ]
        );
    }
}

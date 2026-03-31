<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Driver accounts
        User::create([
            'name' => 'Driver One',
            'email' => 'juma@example.com',
            'password' => Hash::make('password1'),
            'role' => 'driver',
        ]);

        User::create([
            'name' => 'Driver Two',
            'email' => 'kenny@example.com',
            'password' => Hash::make('password2'),
            'role' => 'driver',
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Models\User;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        $driver1 = User::where('email', 'juma@example.com')->first();
        $driver2 = User::where('email', 'kenny@example.com')->first();

        Driver::create([
            'user_id' => $driver1->id,
            'phone' => '0789111111',
            'license_number' => 'DL123456',
        ]);

        Driver::create([
            'user_id' => $driver2->id,
            'phone' => '0789222222',
            'license_number' => 'DL123457',
        ]);
    }
}
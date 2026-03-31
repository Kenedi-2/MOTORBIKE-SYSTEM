<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call individual seeders
        $this->call([
            UserSeeder::class,
            SponsorSeeder::class,
            MotorbikeSeeder::class,
            DriverSeeder::class,
        ]);
    }
}
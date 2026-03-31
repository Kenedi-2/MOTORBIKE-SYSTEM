<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motorbike;

class MotorbikeSeeder extends Seeder
{
    public function run(): void
    {
        Motorbike::create([
            'plate_number' => 'T123ABC',
            'model' => 'Yamaha RX100',
            'engine_number' => 'ENG1001',
            'status' => 'available',
        ]);

        Motorbike::create([
            'plate_number' => 'T124ABC',
            'model' => 'Honda CB150',
            'engine_number' => 'ENG1002',
            'status' => 'available',
        ]);
    }
}
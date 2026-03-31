<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    public function run(): void
    {
        Sponsor::create([
            'name' => 'Simon',
            'phone' => '0789000000',
            'address' => 'Dar es Salaam',
        ]);

        Sponsor::create([
            'name' => 'Japheth',
            'phone' => '0789000001',
            'address' => 'Arusha',
        ]);
    }
}
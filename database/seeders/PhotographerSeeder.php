<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Photographer;

class PhotographerSeeder extends Seeder
{
    public function run()
    {
        Photographer::create(['name' => 'Ahmad', 'email' => 'ahmad@example.com']);
        Photographer::create(['name' => 'Am', 'email' => 'am@example.com']);
    }
}


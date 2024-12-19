<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming you have a User model.

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@momentify.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true, // Add this field if your User model tracks admin users.
        ]);
    }
}

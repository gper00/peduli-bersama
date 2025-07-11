<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'gper',
            'email' => 'admin@pedulibersama.com',
            'password' => Hash::make('kosongin'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'phone_number' => '081234567890',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@pedulibersama.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'phone_number' => '081234567890',
                'bio' => 'Administrator of Peduli Bersama platform',
                'is_active' => true,
            ],
            [
                'name' => 'Donor User',
                'username' => 'donor',
                'email' => 'donor@pedulibersama.com',
                'password' => Hash::make('donor'),
                'role' => 'donor',
                'email_verified_at' => now(),
                'phone_number' => '082345678901',
                'bio' => 'Regular donor on Peduli Bersama',
                'is_active' => true,
            ],
            [
                'name' => 'Creator User',
                'username' => 'creator',
                'email' => 'creator@pedulibersama.com',
                'password' => Hash::make('creator'),
                'role' => 'creator',
                'email_verified_at' => now(),
                'phone_number' => '083456789012',
                'bio' => 'Campaign creator on Peduli Bersama',
                'is_active' => true,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

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
                'image' => null,
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
                'image' => null,
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
                'image' => null,
            ],
            [
                'name' => 'Donor 2',
                'username' => 'donor2',
                'email' => 'donor2@pedulibersama.com',
                'password' => Hash::make('donor2'),
                'role' => 'donor',
                'email_verified_at' => now(),
                'phone_number' => '084567890123',
                'bio' => 'Another regular donor on Peduli Bersama',
                'is_active' => true,
                'image' => null,
            ],
            [
                'name' => 'Creator 2',
                'username' => 'creator2',
                'email' => 'creator2@pedulibersama.com',
                'password' => Hash::make('creator2'),
                'role' => 'creator',
                'email_verified_at' => now(),
                'phone_number' => '085678901234',
                'bio' => 'Another campaign creator on Peduli Bersama',
                'is_active' => true,
                'image' => null,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

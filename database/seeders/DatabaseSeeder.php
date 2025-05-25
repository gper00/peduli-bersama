<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class, // Replacing AdminSeeder
            CampaignSeeder::class,
            DonationSeeder::class,
            CommentSeeder::class,
            CampaignUpdateSeeder::class,
            FeedbackSeeder::class,
            WithdrawalSeeder::class,
        ]);
    }
}

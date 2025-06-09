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
            // CampaignSeeder::class, // Reemplazado por DetailedCampaignSeeder
            DetailedCampaignSeeder::class, // Nuevo seeder con diversos estados de campaña
            // DonationSeeder::class, // Las donaciones están incluidas en DetailedCampaignSeeder
            // CommentSeeder::class, // Los comentarios están incluidos en DetailedCampaignSeeder
            CampaignUpdateSeeder::class,
            FeedbackSeeder::class,
            WithdrawalSeeder::class,
        ]);
    }
}

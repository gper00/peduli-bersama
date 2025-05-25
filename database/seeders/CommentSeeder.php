<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            [
                'campaign_id' => 1, // Bantuan Korban Banjir Bandang Jember
                'user_id' => 2, // Donor user
                'parent_id' => null,
                'comment' => 'Semoga bantuan ini bisa segera disalurkan kepada yang membutuhkan. Saya akan berbagi kampanye ini di media sosial saya.',
                'likes' => 5,
                'is_pinned' => true,
                'status' => 'published',
            ],
            [
                'campaign_id' => 2, // Bantu Biaya Operasi Jantung Dodi
                'user_id' => 2, // Donor user
                'parent_id' => null,
                'comment' => 'Semoga Dodi bisa segera mendapatkan operasi yang dibutuhkan. Saya akan berdoa untuk kesembuhannya.',
                'likes' => 3,
                'is_pinned' => false,
                'status' => 'published',
            ],
            [
                'campaign_id' => 3, // Renovasi Masjid Al-Ikhlas
                'user_id' => 3, // Creator user
                'parent_id' => null,
                'comment' => 'Terima kasih atas dukungan semua donatur. Kami akan memastikan dana digunakan dengan baik dan transparan.',
                'likes' => 8,
                'is_pinned' => true,
                'status' => 'published',
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}

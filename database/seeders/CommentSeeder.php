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
            [
                'campaign_id' => 1, // Bantuan Korban Banjir Bandang Jember
                'user_id' => 4, // Donor 2
                'parent_id' => 1, // Reply to first comment
                'comment' => 'Saya juga sudah berbagi di media sosial saya. Semoga semakin banyak yang membantu.',
                'likes' => 2,
                'is_pinned' => false,
                'status' => 'published',
            ],
            [
                'campaign_id' => 4, // Bantuan Modal Usaha UMKM
                'user_id' => 5, // Creator 2
                'parent_id' => null,
                'comment' => 'Program ini akan membantu banyak pengusaha kecil. Kami akan memastikan dana digunakan dengan tepat.',
                'likes' => 4,
                'is_pinned' => true,
                'status' => 'published',
            ],
            [
                'campaign_id' => 5, // Beasiswa Anak Yatim
                'user_id' => null, // Guest user
                'parent_id' => null,
                'comment' => 'Program yang sangat mulia. Semoga bisa membantu banyak anak yatim.',
                'likes' => 6,
                'is_pinned' => false,
                'status' => 'pending',
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}

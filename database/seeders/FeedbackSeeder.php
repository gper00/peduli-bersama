<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = [
            [
                'user_id' => 2, // Donor user
                'name' => 'Donor User',
                'email' => 'donor@pedulibersama.com',
                'subject' => 'Saran Perbaikan Tampilan Website',
                'type' => 'suggestion',
                'priority' => 'medium',
                'message' => 'Saya menyarankan agar tampilan halaman donasi dibuat lebih sederhana dan mudah digunakan, terutama pada bagian pembayaran. Terima kasih.',
                'status' => 'read',
                'admin_notes' => 'Akan diteruskan ke tim UI/UX',
            ],
            [
                'user_id' => null,
                'name' => 'Pengunjung Website',
                'email' => 'pengunjung@example.com',
                'subject' => 'Masalah saat Melakukan Donasi',
                'type' => 'complaint',
                'priority' => 'high',
                'message' => 'Saya mengalami kesulitan saat mencoba melakukan donasi. Setelah memasukkan informasi pembayaran, halaman tidak merespon. Mohon bantuan untuk mengatasi masalah ini.',
                'status' => 'in_progress',
                'admin_notes' => 'Bug telah dilaporkan ke tim developer',
            ],
            [
                'user_id' => 3, // Creator user
                'name' => 'Creator User',
                'email' => 'creator@pedulibersama.com',
                'subject' => 'Apresiasi untuk Peduli Bersama',
                'type' => 'appreciation',
                'priority' => 'low',
                'message' => 'Saya ingin menyampaikan apresiasi untuk platform Peduli Bersama yang telah membantu banyak orang menyalurkan bantuan. Terima kasih atas dedikasi tim dalam mengembangkan platform ini.',
                'status' => 'read',
                'admin_notes' => 'Sampaikan terima kasih dari tim',
            ],
        ];

        foreach ($feedbacks as $feedback) {
            Feedback::create($feedback);
        }
    }
}

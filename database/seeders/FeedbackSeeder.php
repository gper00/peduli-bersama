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
                'campaign_id' => 1, // Bantuan Korban Banjir Bandang Jember
                'donation_id' => 1,
                'name' => 'Donor User',
                'email' => 'donor@pedulibersama.com',
                'subject' => 'Saran untuk Platform',
                'type' => 'suggestion',
                'priority' => 'medium',
                'message' => 'Saya ingin memberikan saran untuk menambahkan fitur notifikasi email ketika ada update kampanye yang kita donasikan.',
                'status' => 'unread',
                'admin_notes' => null,
            ],
            [
                'user_id' => 3, // Creator user
                'campaign_id' => 2, // Bantu Biaya Operasi Jantung Dodi
                'donation_id' => 2,
                'name' => 'Creator User',
                'email' => 'creator@pedulibersama.com',
                'subject' => 'Apresiasi untuk Peduli Bersama',
                'type' => 'appreciation',
                'priority' => 'low',
                'message' => 'Saya ingin menyampaikan apresiasi untuk platform Peduli Bersama yang telah membantu banyak orang menyalurkan bantuan. Terima kasih atas dedikasi tim dalam mengembangkan platform ini.',
                'status' => 'read',
                'admin_notes' => 'Sampaikan terima kasih dari tim',
            ],
            [
                'user_id' => null, // Guest user
                'campaign_id' => 3, // Renovasi Masjid Al-Ikhlas
                'donation_id' => 3,
                'name' => 'Guest Donatur',
                'email' => 'guest@example.com',
                'subject' => 'Feedback dari Guest',
                'type' => 'suggestion',
                'priority' => 'medium',
                'message' => 'Saya donasi sebagai tamu dan ingin memberikan saran.',
                'status' => 'unread',
                'admin_notes' => null,
            ],
            [
                'user_id' => 4, // Donor 2
                'campaign_id' => 4, // Bantuan Modal Usaha UMKM
                'donation_id' => 4,
                'name' => 'Donor 2',
                'email' => 'donor2@pedulibersama.com',
                'subject' => 'Kendala Pembayaran',
                'type' => 'complaint',
                'priority' => 'high',
                'message' => 'Saya mengalami kendala saat melakukan pembayaran menggunakan kartu kredit. Mohon bantuannya.',
                'status' => 'in_progress',
                'admin_notes' => 'Hubungi tim payment gateway',
            ],
            [
                'user_id' => 5, // Creator 2
                'campaign_id' => 5, // Beasiswa Anak Yatim
                'donation_id' => 5,
                'name' => 'Creator 2',
                'email' => 'creator2@pedulibersama.com',
                'subject' => 'Saran Fitur Campaign',
                'type' => 'suggestion',
                'priority' => 'medium',
                'message' => 'Saya ingin memberikan saran untuk menambahkan fitur galeri foto di halaman kampanye.',
                'status' => 'unread',
                'admin_notes' => null,
            ],
            [
                'user_id' => null, // Guest user
                'campaign_id' => null,
                'donation_id' => null,
                'name' => 'Pengunjung Website',
                'email' => 'visitor@example.com',
                'subject' => 'Pertanyaan Umum',
                'type' => 'question',
                'priority' => 'low',
                'message' => 'Bagaimana cara menjadi donatur tetap di platform ini?',
                'status' => 'unread',
                'admin_notes' => null,
            ],
        ];

        foreach ($feedbacks as $feedback) {
            Feedback::create($feedback);
        }
    }
}

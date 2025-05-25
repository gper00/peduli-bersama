<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CampaignUpdate;

class CampaignUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $updates = [
            [
                'campaign_id' => 1, // Bantuan Korban Banjir Bandang Jember
                'user_id' => 3, // Creator user
                'title' => 'Distribusi Bantuan Tahap Pertama',
                'description' => 'Alhamdulillah, hari ini kami telah mendistribusikan bantuan tahap pertama berupa makanan, air bersih, dan selimut kepada 100 keluarga terdampak banjir di Desa Sukorambi, Jember. Terima kasih atas bantuan para donatur yang telah memungkinkan hal ini terjadi.',
                'type' => 'report',
                'status' => 'published',
                'pinned' => true,
            ],
            [
                'campaign_id' => 2, // Bantu Biaya Operasi Jantung Dodi
                'user_id' => 3, // Creator user
                'title' => 'Dodi Dijadwalkan Operasi',
                'description' => 'Kabar baik! Dodi telah dijadwalkan untuk operasi pada tanggal 30 Juni 2025. Dokter menyatakan bahwa kondisinya stabil dan siap untuk menjalani operasi. Kami sangat berterima kasih atas dukungan dan doa dari semua donatur.',
                'type' => 'milestone',
                'status' => 'published',
                'pinned' => false,
            ],
            [
                'campaign_id' => 3, // Renovasi Masjid Al-Ikhlas
                'user_id' => 3, // Creator user
                'title' => 'Pembelian Material Bangunan',
                'description' => 'Dana yang terkumpul sudah mulai kami gunakan untuk membeli material bangunan seperti semen, pasir, dan batu bata. Renovasi akan dimulai minggu depan dan kami akan terus memberikan update perkembangannya. Berikut adalah rincian penggunaan dana untuk pembelian material tahap awal.',
                'type' => 'general',
                'status' => 'published',
                'pinned' => true,
            ],
        ];

        foreach ($updates as $update) {
            CampaignUpdate::create($update);
        }
    }
}

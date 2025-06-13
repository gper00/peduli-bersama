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
                'description' => 'Dana yang terkumpul sudah mulai kami gunakan untuk membeli material bangunan seperti semen, pasir, dan batu bata. Renovasi akan dimulai minggu depan dan kami akan terus memberikan update perkembangannya.',
                'type' => 'report',
                'status' => 'published',
                'pinned' => true,
            ],
            [
                'campaign_id' => 4, // Bantuan Modal Usaha UMKM
                'user_id' => 5, // Creator 2
                'title' => 'Pendaftaran UMKM Dibuka',
                'description' => 'Pendaftaran untuk program bantuan modal usaha UMKM telah dibuka. Silakan daftarkan usaha Anda melalui formulir yang tersedia. Kami akan memilih penerima bantuan berdasarkan kriteria yang telah ditetapkan.',
                'type' => 'general',
                'status' => 'published',
                'pinned' => true,
            ],
            [
                'campaign_id' => 5, // Beasiswa Anak Yatim
                'user_id' => 5, // Creator 2
                'title' => 'Seleksi Penerima Beasiswa',
                'description' => 'Proses seleksi penerima beasiswa sedang berlangsung. Kami telah menerima lebih dari 50 pendaftar dan sedang melakukan verifikasi dokumen serta wawancara dengan calon penerima beasiswa.',
                'type' => 'milestone',
                'status' => 'published',
                'pinned' => false,
            ],
            [
                'campaign_id' => 1, // Bantuan Korban Banjir Bandang Jember
                'user_id' => 3, // Creator user
                'title' => 'Update Kondisi Korban Banjir',
                'description' => 'Kondisi korban banjir di Desa Sukorambi mulai membaik. Air sudah mulai surut dan proses pembersihan sedang dilakukan. Namun, masih banyak yang membutuhkan bantuan untuk membangun kembali rumah mereka.',
                'type' => 'report',
                'status' => 'draft',
                'pinned' => false,
            ],
        ];

        foreach ($updates as $update) {
            CampaignUpdate::create($update);
        }
    }
}

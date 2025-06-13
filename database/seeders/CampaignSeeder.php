<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use Illuminate\Support\Str;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaigns = [
            [
                'user_id' => 3, // Creator user
                'category_id' => 1, // Bencana Alam
                'title' => 'Bantuan Korban Banjir Bandang Jember',
                'slug' => 'bantuan-korban-banjir-bandang-jember',
                'short_description' => 'Mari bantu saudara kita yang terdampak banjir bandang di Jember',
                'description' => 'Banjir bandang telah melanda Kabupaten Jember, Jawa Timur pada tanggal 20 Mei 2025. Lebih dari 500 keluarga kehilangan tempat tinggal mereka dan membutuhkan bantuan segera berupa makanan, pakaian, dan tempat tinggal sementara. Donasi Anda akan digunakan untuk menyediakan kebutuhan dasar bagi para korban bencana.',
                'target_amount' => 100000000,
                'current_amount' => 0,
                'start_date' => '2025-05-22',
                'end_date' => '2025-06-22',
                'status' => 'active',
                'verification_status' => 'verified',
                'featured' => true,
                'cover_image' => null,
            ],
            [
                'user_id' => 3, // Creator user
                'category_id' => 3, // Sakit
                'title' => 'Bantu Biaya Operasi Jantung Dodi',
                'slug' => 'bantu-biaya-operasi-jantung-dodi',
                'short_description' => 'Dodi (8) membutuhkan operasi jantung untuk dapat terus hidup',
                'description' => 'Dodi, anak berusia 8 tahun dari keluarga kurang mampu di Surabaya, didiagnosis memiliki kelainan jantung bawaan yang membutuhkan operasi segera. Keluarganya tidak mampu membiayai operasi yang diperkirakan menghabiskan biaya sekitar Rp 150 juta. Bantuan Anda akan memberikan kesempatan hidup kedua bagi Dodi.',
                'target_amount' => 150000000,
                'current_amount' => 0,
                'start_date' => '2025-05-15',
                'end_date' => '2025-07-15',
                'status' => 'active',
                'verification_status' => 'verified',
                'featured' => false,
                'cover_image' => null,
            ],
            [
                'user_id' => 3, // Creator user
                'category_id' => 5, // Pembangunan Tempat Ibadah
                'title' => 'Renovasi Masjid Al-Ikhlas',
                'slug' => 'renovasi-masjid-al-ikhlas',
                'short_description' => 'Masjid Al-Ikhlas membutuhkan renovasi setelah 25 tahun',
                'description' => 'Masjid Al-Ikhlas di desa Karanganyar telah berdiri selama 25 tahun dan melayani lebih dari 500 jamaah. Namun, kondisi bangunan sudah sangat memprihatinkan dengan atap yang bocor dan dinding yang retak. Kami membutuhkan dana untuk renovasi agar masjid dapat kembali menjadi tempat ibadah yang nyaman dan aman bagi jamaah.',
                'target_amount' => 200000000,
                'current_amount' => 0,
                'start_date' => '2025-05-10',
                'end_date' => '2025-08-10',
                'status' => 'active',
                'verification_status' => 'verified',
                'featured' => true,
                'cover_image' => null,
            ],
            [
                'user_id' => 3, // Creator user
                'category_id' => 2, // Kurang Mampu
                'title' => 'Bantuan Modal Usaha UMKM',
                'slug' => 'bantuan-modal-usaha-umkm',
                'short_description' => 'Bantu pengusaha kecil untuk mengembangkan usahanya',
                'description' => 'Program ini bertujuan membantu pengusaha kecil yang membutuhkan modal untuk mengembangkan usahanya. Dana yang terkumpul akan digunakan untuk memberikan pinjaman modal usaha dengan bunga rendah kepada pengusaha UMKM yang terpilih.',
                'target_amount' => 50000000,
                'current_amount' => 0,
                'start_date' => '2025-06-01',
                'end_date' => '2025-09-01',
                'status' => 'active',
                'verification_status' => 'verified',
                'featured' => false,
                'cover_image' => null,
            ],
            [
                'user_id' => 3, // Creator user
                'category_id' => 4, // Yatim Piatu
                'title' => 'Beasiswa Anak Yatim',
                'slug' => 'beasiswa-anak-yatim',
                'short_description' => 'Bantu pendidikan anak-anak yatim di panti asuhan',
                'description' => 'Program beasiswa untuk anak-anak yatim di panti asuhan Al-Hidayah. Dana yang terkumpul akan digunakan untuk biaya sekolah, seragam, buku, dan kebutuhan pendidikan lainnya.',
                'target_amount' => 75000000,
                'current_amount' => 0,
                'start_date' => '2025-06-15',
                'end_date' => '2025-12-15',
                'status' => 'active',
                'verification_status' => 'verified',
                'featured' => true,
                'cover_image' => null,
            ],
        ];

        foreach ($campaigns as $campaign) {
            Campaign::create($campaign);
        }
    }
}

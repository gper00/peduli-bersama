<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DetailedCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurarnos que tenemos categorías y usuarios para asignar a las campañas
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->command->error('No hay categorías disponibles. Por favor, ejecute CategorySeeder primero.');
            return;
        }

        $users = User::whereIn('role', ['admin', 'creator'])->get();
        if ($users->isEmpty()) {
            $this->command->error('No hay usuarios disponibles. Por favor, ejecute UserSeeder primero.');
            return;
        }

        // Crear campañas con diferentes estados y características
        $this->createCampaigns($categories, $users);

        // Actualizar contador de donantes y monto actual
        $this->updateCampaignDonations();

        $this->command->info('Campañas, donaciones y comentarios creados exitosamente.');
    }

    /**
     * Crear varias campañas con diferentes estados y configuraciones
     */
    private function createCampaigns($categories, $users)
    {
        // 1. Campaña verificada y activa creada por un creator
        $creatorUser = $users->where('role', 'creator')->first();
        $campaign1 = Campaign::create([
            'user_id' => $creatorUser->id,
            'category_id' => $categories->random()->id,
            'title' => 'Bantu Renovasi Sekolah Terdampak Banjir',
            'slug' => 'bantu-renovasi-sekolah-terdampak-banjir-'.Str::random(6),
            'short_description' => 'Membantu renovasi sekolah dasar yang rusak akibat banjir bandang bulan lalu',
            'description' => '<p>Sekolah Dasar Negeri 01 Sukamanah mengalami kerusakan parah akibat banjir bandang yang terjadi pada bulan lalu. Atap sekolah rusak, dinding retak, dan banyak peralatan belajar yang rusak.</p><p>Dana yang terkumpul akan digunakan untuk:</p><ul><li>Perbaikan atap dan dinding sekolah</li><li>Pengadaan meja dan kursi baru</li><li>Pembelian buku-buku pelajaran</li><li>Renovasi toilet sekolah</li></ul><p>Mari bantu anak-anak untuk bisa kembali belajar dengan nyaman!</p>',
            'target_amount' => 150000000,
            'current_amount' => 0,
            'start_date' => Carbon::now()->subDays(15),
            'end_date' => Carbon::now()->addMonth(2),
            'status' => 'active',
            'verification_status' => 'verified',
            'featured' => true,
            'cover_image' => 'campaigns/sekolah-banjir.jpg',
        ]);

        // Menambahkan donasi dan komentar untuk campaign 1
        $this->addDonationsAndComments($campaign1, 12);

        // 2. Campaña creada por admin (automáticamente verificada)
        $adminUser = $users->where('role', 'admin')->first();
        $campaign2 = Campaign::create([
            'user_id' => $adminUser->id,
            'category_id' => $categories->random()->id,
            'title' => 'Program Beasiswa untuk Anak Prasejahtera',
            'slug' => 'program-beasiswa-untuk-anak-prasejahtera-'.Str::random(6),
            'short_description' => 'Program beasiswa untuk membantu pendidikan anak-anak dari keluarga prasejahtera',
            'description' => '<p>Program beasiswa ini bertujuan membantu anak-anak dari keluarga prasejahtera untuk tetap dapat melanjutkan pendidikan. Beasiswa mencakup biaya sekolah, seragam, buku, dan uang saku.</p><p>Kriteria penerima beasiswa:</p><ul><li>Anak dari keluarga prasejahtera</li><li>Nilai rata-rata minimal 7.5</li><li>Berkomitmen untuk menyelesaikan pendidikan</li></ul><p>Setiap donasi akan membuat perbedaan besar dalam hidup mereka!</p>',
            'target_amount' => 200000000,
            'current_amount' => 0,
            'start_date' => Carbon::now()->subDays(5),
            'end_date' => Carbon::now()->addMonths(6),
            'status' => 'active',
            'verification_status' => 'verified',
            'featured' => true,
            'cover_image' => 'campaigns/beasiswa.jpg',
        ]);

        // Menambahkan donasi dan komentar untuk campaign 2
        $this->addDonationsAndComments($campaign2, 8);

        // 3. Campaña en espera de verificación
        $campaign3 = Campaign::create([
            'user_id' => $creatorUser->id,
            'category_id' => $categories->random()->id,
            'title' => 'Bantu Biaya Operasi Jantung Pak Hadi',
            'slug' => 'bantu-biaya-operasi-jantung-pak-hadi-'.Str::random(6),
            'short_description' => 'Pak Hadi membutuhkan bantuan untuk operasi jantung yang harus dilakukan segera',
            'description' => '<p>Pak Hadi (45 tahun) seorang buruh harian dengan 3 anak, terdiagnosis penyakit jantung koroner yang membutuhkan operasi segera. Tanpa BPJS dan tabungan yang cukup, keluarganya kesulitan menanggung biaya operasi.</p><p>Biaya yang dibutuhkan meliputi:</p><ul><li>Operasi jantung: Rp 100.000.000</li><li>Perawatan pasca operasi: Rp 20.000.000</li><li>Obat-obatan: Rp 15.000.000</li></ul><p>Bantuanmu sangat berarti untuk menyelamatkan nyawa Pak Hadi!</p>',
            'target_amount' => 135000000,
            'current_amount' => 0,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(1),
            'status' => 'active',
            'verification_status' => 'pending',
            'featured' => false,
            'cover_image' => 'campaigns/operasi-jantung.jpg',
        ]);

        // 4. Campaña rechazada
        $campaign4 = Campaign::create([
            'user_id' => $creatorUser->id,
            'category_id' => $categories->random()->id,
            'title' => 'Dana untuk Pembangunan Rumah Pribadi',
            'slug' => 'dana-untuk-pembangunan-rumah-pribadi-'.Str::random(6),
            'short_description' => 'Bantuan pembangunan rumah pribadi yang rusak',
            'description' => '<p>Saya membutuhkan dana untuk membangun kembali rumah pribadi yang rusak. Rumah ini adalah tempat tinggal saya dan keluarga.</p>',
            'target_amount' => 500000000,
            'current_amount' => 0,
            'start_date' => Carbon::now()->subDays(10),
            'end_date' => Carbon::now()->addMonths(3),
            'status' => 'active',
            'verification_status' => 'rejected',
            'rejection_reason' => 'Campaign ini untuk kepentingan pribadi dan tidak memenuhi kriteria campaign di platform kami',
            'featured' => false,
            'cover_image' => 'campaigns/rumah.jpg',
        ]);

        // 5. Campaña completada
        $campaign5 = Campaign::create([
            'user_id' => $creatorUser->id,
            'category_id' => $categories->random()->id,
            'title' => 'Bantuan Bencana Gempa Cianjur',
            'slug' => 'bantuan-bencana-gempa-cianjur-'.Str::random(6),
            'short_description' => 'Bantuan untuk korban gempa bumi di Cianjur',
            'description' => '<p>Gempa berkekuatan 5.6 SR telah mengguncang Cianjur dan sekitarnya. Ratusan rumah rusak dan banyak korban yang kehilangan tempat tinggal.</p><p>Dana akan digunakan untuk:</p><ul><li>Bantuan logistik: makanan, air bersih, selimut</li><li>Tenda pengungsian</li><li>Obat-obatan dan kebutuhan medis</li><li>Kebutuhan anak-anak dan lansia</li></ul><p>Mari bersama bantu saudara-saudara kita di Cianjur!</p>',
            'target_amount' => 100000000,
            'current_amount' => 100000000, // Sudah mencapai target
            'start_date' => Carbon::now()->subMonths(3),
            'end_date' => Carbon::now()->subDays(15),
            'status' => 'completed',
            'verification_status' => 'verified',
            'featured' => false,
            'cover_image' => 'campaigns/gempa-cianjur.jpg',
        ]);

        // Menambahkan donasi dan komentar untuk campaign 5 (completed)
        $this->addDonationsAndComments($campaign5, 20);

        // 6. Campaña en borrador
        $campaign6 = Campaign::create([
            'user_id' => $creatorUser->id,
            'category_id' => $categories->random()->id,
            'title' => 'Bantuan Biaya Kuliah Mahasiswa Berprestasi',
            'slug' => 'bantuan-biaya-kuliah-mahasiswa-berprestasi-'.Str::random(6),
            'short_description' => 'Bantuan biaya kuliah untuk mahasiswa berprestasi dari keluarga tidak mampu',
            'description' => '<p>Program ini ditujukan untuk membantu mahasiswa berprestasi dari keluarga tidak mampu agar dapat menyelesaikan pendidikan tinggi mereka. Banyak mahasiswa berbakat terpaksa berhenti kuliah karena keterbatasan biaya.</p><p>Dana akan digunakan untuk:</p><ul><li>Biaya kuliah per semester</li><li>Biaya hidup sederhana</li><li>Buku dan perlengkapan kuliah</li></ul><p>Dengan bantuanmu, kita bisa menciptakan masa depan lebih baik bagi mereka!</p>',
            'target_amount' => 75000000,
            'current_amount' => 0,
            'start_date' => Carbon::now()->addDays(5),
            'end_date' => Carbon::now()->addMonths(4),
            'status' => 'draft',
            'verification_status' => 'pending',
            'featured' => false,
            'cover_image' => 'campaigns/mahasiswa.jpg',
        ]);
    }

    /**
     * Añadir donaciones y comentarios a una campaña
     */
    private function addDonationsAndComments($campaign, $count = 5)
    {
        $donors = User::where('role', 'donor')->take($count)->get();

        // Si no hay suficientes usuarios donantes, creamos algunos temporales
        if ($donors->count() < $count) {
            for ($i = $donors->count(); $i < $count; $i++) {
                $donors->push(User::create([
                    'name' => 'Donor ' . ($i + 1),
                    'email' => 'donor' . ($i + 1) . '@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'donor',
                ]));
            }
        }

        $totalAmount = 0;
        $donorCount = 0;

        // Crear donaciones
        foreach ($donors as $index => $donor) {
            $amount = rand(5, 50) * 10000; // Montos entre 50K y 500K
            $isAnonymous = rand(0, 10) > 7; // 30% de probabilidad de ser anónimo

            $donation = Donation::create([
                'invoice_number' => 'INV-' . time() . '-' . Str::random(6),
                'campaign_id' => $campaign->id,
                'user_id' => $isAnonymous ? null : $donor->id,
                'amount' => $amount,
                'status' => 'success',
                'payment_method' => ['bank_transfer', 'credit_card', 'e-wallet'][rand(0, 2)],
                'anonymous' => $isAnonymous,
                'donor_name' => $isAnonymous ? 'Anonim' : $donor->name,
                'donor_email' => $isAnonymous ? 'anonim' . rand(1, 100) . '@example.com' : $donor->email,
                'message' => ['Semoga bermanfaat', 'Sukses selalu', 'Semoga cepat terkumpul', 'Ikhlas membantu'][rand(0, 3)],
                'transaction_id' => 'TRX-' . Str::random(10),
                'payment_date' => Carbon::now()->subDays(rand(1, 14)),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            // Solo contar donaciones exitosas
            if ($donation->status === 'success') {
                $totalAmount += $amount;
                $donorCount++;

                // Añadir comentario para algunas donaciones
                if (rand(0, 10) > 5) { // 50% de probabilidad
                    $commentData = [
                        'campaign_id' => $campaign->id,
                        'comment' => ['Semoga cepat sembuh!', 'Saya ikut membantu, semoga bermanfaat', 'Semoga segera terkumpul dananya', 'Saya doakan lancar semua prosesnya'][rand(0, 3)],
                        'status' => 'published',
                        'created_at' => Carbon::now()->subDays(rand(1, 20)),
                    ];

                    if ($isAnonymous) {
                        $commentData['guest_name'] = 'Anonim ' . rand(1, 100);
                    } else {
                        $commentData['user_id'] = $donor->id;
                    }

                    Comment::create($commentData);
                }
            }
        }

        // Actualizar totales en la campaña
        $campaign->update([
            'current_amount' => $totalAmount,
            'donor_count' => $donorCount
        ]);
    }

    /**
     * Actualizar contadores de donaciones en todas las campañas
     */
    private function updateCampaignDonations()
    {
        $campaigns = Campaign::all();

        foreach ($campaigns as $campaign) {
            // Calcular donaciones exitosas
            $totalDonations = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->sum('amount');

            // Contar donadores
            $donorCount = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'success')
                ->count();

            // Actualizar campaña
            $campaign->update([
                'current_amount' => $totalDonations,
                'donor_count' => $donorCount
            ]);
        }
    }
}

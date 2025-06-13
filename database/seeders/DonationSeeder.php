<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donation;
use Illuminate\Support\Str;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donations = [
            [
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
                'campaign_id' => 1, // Bantuan Korban Banjir Bandang Jember
                'user_id' => 2, // Donor user
                'amount' => 500000,
                'status' => 'success',
                'payment_method' => 'bank_transfer',
                'payment_code' => 'BCA123456',
                'payment_date' => now(),
                'anonymous' => false,
                'donor_name' => 'Donor User',
                'donor_email' => 'donor@pedulibersama.com',
                'donor_phone' => '082345678901',
                'message' => 'Semoga bantuan ini bermanfaat untuk saudara-saudara kita yang terkena bencana',
            ],
            [
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
                'campaign_id' => 2, // Bantu Biaya Operasi Jantung Dodi
                'user_id' => 2, // Donor user
                'amount' => 1000000,
                'status' => 'success',
                'payment_method' => 'bank_transfer',
                'payment_code' => 'BCA654321',
                'payment_date' => now(),
                'anonymous' => false,
                'donor_name' => 'Donor User',
                'donor_email' => 'donor@pedulibersama.com',
                'donor_phone' => '082345678901',
                'message' => 'Semoga Dodi lekas sembuh',
            ],
            [
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
                'campaign_id' => 3, // Renovasi Masjid Al-Ikhlas
                'user_id' => null, // Anonymous user
                'amount' => 250000,
                'status' => 'success',
                'payment_method' => 'e_wallet',
                'payment_code' => 'GOPAY123',
                'payment_date' => now(),
                'anonymous' => true,
                'donor_name' => 'Hamba Allah',
                'donor_email' => 'anonymous@example.com',
                'donor_phone' => '089876543210',
                'message' => 'Semoga menjadi amal jariyah',
            ],
            [
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
                'campaign_id' => 1, // Bantuan Korban Banjir Bandang Jember
                'user_id' => 4, // Donor 2
                'amount' => 750000,
                'status' => 'success',
                'payment_method' => 'credit_card',
                'payment_code' => 'CC123456',
                'payment_date' => now(),
                'anonymous' => false,
                'donor_name' => 'Donor 2',
                'donor_email' => 'donor2@pedulibersama.com',
                'donor_phone' => '084567890123',
                'message' => 'Semoga bantuan ini bisa meringankan beban mereka',
            ],
            [
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
                'campaign_id' => 4, // Bantuan Modal Usaha UMKM
                'user_id' => 2, // Donor user
                'amount' => 1000000,
                'status' => 'pending',
                'payment_method' => 'bank_transfer',
                'payment_code' => 'BCA789012',
                'payment_date' => null,
                'anonymous' => false,
                'donor_name' => 'Donor User',
                'donor_email' => 'donor@pedulibersama.com',
                'donor_phone' => '082345678901',
                'message' => 'Semoga usaha mereka bisa berkembang',
            ],
            [
                'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
                'campaign_id' => 5, // Beasiswa Anak Yatim
                'user_id' => 4, // Donor 2
                'amount' => 500000,
                'status' => 'failed',
                'payment_method' => 'e_wallet',
                'payment_code' => 'GOPAY456',
                'payment_date' => null,
                'anonymous' => true,
                'donor_name' => 'Anonim',
                'donor_email' => 'anonim@example.com',
                'donor_phone' => '089876543211',
                'message' => 'Semoga bisa membantu pendidikan mereka',
            ],
        ];

        foreach ($donations as $donation) {
            Donation::create($donation);
        }
    }
}

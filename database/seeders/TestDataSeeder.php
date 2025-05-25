<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Campaign;
use Illuminate\Support\Str;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test category if none exists
        if (Category::count() === 0) {
            Category::create([
                'name' => 'Pendidikan',
                'slug' => 'pendidikan',
                'description' => 'Kategori untuk campaign pendidikan',
                'icon' => 'fas fa-graduation-cap',
                'color' => '#1E88E5',
                'is_active' => true,
                'sort_order' => 1,
            ]);
            
            Category::create([
                'name' => 'Kesehatan',
                'slug' => 'kesehatan',
                'description' => 'Kategori untuk campaign kesehatan',
                'icon' => 'fas fa-heartbeat',
                'color' => '#D81B60',
                'is_active' => true,
                'sort_order' => 2,
            ]);
        }

        // Get admin user (assuming it exists)
        $admin = User::where('role', 'admin')->first();
        
        // If no admin exists, use the first user
        if (!$admin) {
            $admin = User::first();
        }
        
        // Create a test campaign
        if ($admin && Campaign::count() === 0) {
            Campaign::create([
                'user_id' => $admin->id,
                'category_id' => Category::first()->id,
                'title' => 'Test Campaign',
                'slug' => 'test-campaign-' . Str::random(6),
                'short_description' => 'Ini adalah kampanye test untuk pengembangan',
                'description' => '<p>Ini adalah deskripsi lengkap dari kampanye test untuk tujuan pengembangan. Teks ini sengaja dibuat panjang untuk memenuhi validasi minimum.</p><p>Kampanye ini hanya untuk keperluan testing fitur pada platform donasi. Kampanye ini tidak akan muncul pada tampilan publik dan hanya untuk keperluan pengembangan.</p>',
                'target_amount' => 10000000,
                'current_amount' => 2500000,
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'status' => 'active',
                'verification_status' => 'verified',
                'featured' => true,
                'donor_count' => 5,
                'view_count' => 120,
                'share_count' => 25,
            ]);
            
            Campaign::create([
                'user_id' => $admin->id,
                'category_id' => Category::all()->last()->id,
                'title' => 'Draft Campaign',
                'slug' => 'draft-campaign-' . Str::random(6),
                'short_description' => 'Ini adalah kampanye draft untuk pengembangan',
                'description' => '<p>Ini adalah deskripsi lengkap dari kampanye draft untuk tujuan pengembangan. Teks ini sengaja dibuat panjang untuk memenuhi validasi minimum.</p><p>Kampanye ini masih berstatus draft dan belum aktif untuk ditampilkan ke publik.</p>',
                'target_amount' => 5000000,
                'current_amount' => 0,
                'start_date' => now()->addDays(5),
                'end_date' => now()->addMonths(2),
                'status' => 'draft',
                'verification_status' => 'pending',
                'featured' => false,
                'donor_count' => 0,
                'view_count' => 10,
                'share_count' => 0,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bencana Alam',
                'slug' => 'bencana-alam',
                'description' => 'Bantuan untuk korban bencana alam seperti gempa bumi, banjir, tanah longsor, dll.',
                'icon' => 'fas fa-house-damage',
                'color' => '#dc3545',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Kurang Mampu',
                'slug' => 'kurang-mampu',
                'description' => 'Bantuan untuk saudara-saudara kita yang kurang mampu secara ekonomi.',
                'icon' => 'fas fa-hand-holding-heart',
                'color' => '#28a745',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Sakit',
                'slug' => 'sakit',
                'description' => 'Bantuan untuk biaya pengobatan dan perawatan medis.',
                'icon' => 'fas fa-hospital',
                'color' => '#007bff',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Yatim Piatu',
                'slug' => 'yatim-piatu',
                'description' => 'Bantuan untuk anak-anak yatim, piatu, dan yatim piatu.',
                'icon' => 'fas fa-child',
                'color' => '#ffc107',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Pembangunan Tempat Ibadah',
                'slug' => 'pembangunan-tempat-ibadah',
                'description' => 'Bantuan untuk pembangunan dan renovasi tempat ibadah.',
                'icon' => 'fas fa-mosque',
                'color' => '#6610f2',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            // Cek apakah kategori dengan slug yang sama sudah ada
            if (!Category::where('slug', $category['slug'])->exists()) {
                Category::create($category);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

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
                'description' => 'Bantuan untuk korban bencana alam seperti gempa bumi, banjir, tanah longsor, dll.',
                'icon' => 'fas fa-house-damage',
            ],
            [
                'name' => 'Kurang Mampu',
                'description' => 'Bantuan untuk saudara-saudara kita yang kurang mampu secara ekonomi.',
                'icon' => 'fas fa-hand-holding-heart',
            ],
            [
                'name' => 'Sakit',
                'description' => 'Bantuan untuk biaya pengobatan dan perawatan medis.',
                'icon' => 'fas fa-hospital',
            ],
            [
                'name' => 'Yatim Piatu',
                'description' => 'Bantuan untuk anak-anak yatim, piatu, dan yatim piatu.',
                'icon' => 'fas fa-child',
            ],
            [
                'name' => 'Pembangunan Tempat Ibadah',
                'description' => 'Bantuan untuk pembangunan dan renovasi tempat ibadah.',
                'icon' => 'fas fa-mosque',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Pastikan model Category sudah benar

class CategorySeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        // Kategori untuk makanan
        Category::create([
            'name' => 'Makanan',
            'description' => 'Kategori untuk semua jenis makanan, baik ringan maupun berat.',
        ]);

        // Kategori untuk minuman
        Category::create([
            'name' => 'Minuman',
            'description' => 'Kategori untuk berbagai jenis minuman, termasuk minuman bersoda, jus, dan lainnya.',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
    Category::create([
        'name' => 'Elektronik Rumah Tangga',
        'description' => 'Kategori yang mencakup berbagai peralatan elektronik untuk rumah tangga.',
    ]);
    Category::create([
        'name' => 'Perabotan Rumah Tangga',
        'description' => 'Kategori yang mencakup berbagai peralatan Perabotan untuk rumah tangga.',
    ]);
    Category::create([
        'name' => 'Aksesoris Rumah Tangga',
        'description' => 'Kategori yang mencakup berbagai peralatan Aksesoris untuk rumah tangga.',
    ]);
}
}

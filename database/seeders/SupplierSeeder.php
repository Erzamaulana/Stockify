<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier; // Pastikan model Supplier sudah dibuat

class SupplierSeeder extends Seeder
{
    /**
     * Jalankan seeder.
     */
    public function run(): void
    {
        Supplier::create([
            'name'    => 'Sumber Segar',
            'address' => 'Jl. Pahlawan No. 1, Jakarta',
            'phone'   => '0211234567',
            'email'   => 'sumbersegar@example.com',
        ]);

        Supplier::create([
            'name'    => 'Bumi Organik',
            'address' => 'Jl. Organik No. 2, Bandung',
            'phone'   => '0229876543',
            'email'   => 'bumiorganik@example.com',
        ]);

        Supplier::create([
            'name'    => 'Delicious Foods',
            'address' => 'Jl. Makanan No. 3, Surabaya',
            'phone'   => '0317654321',
            'email'   => 'delicious@example.com',
        ]);

        Supplier::create([
            'name'    => 'Prima Rasa',
            'address' => 'Jl. Rasa No. 4, Medan',
            'phone'   => '0612345678',
            'email'   => 'primarasa@example.com',
        ]);

        Supplier::create([
            'name'    => 'Cita Rasa',
            'address' => 'Jl. Cita No. 5, Yogyakarta',
            'phone'   => '0274123456',
            'email'   => 'citarasa@example.com',
        ]);
    }
}

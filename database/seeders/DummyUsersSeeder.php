<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Erza Maulana',
                'email' => 'erza@example.com',
                'password' => bcrypt('252525'),
                'role' => 'Admin',
            ],
            [
                'name' => 'Tasya Maulana',
                'email' => 'tasya@example.com',
                'password' => bcrypt('252525'),
                'role' => 'Staff Gudang',
            ],
            [
                'name' => 'Wanza Molan',
                'email' => 'wanza@example.com',
                'password' => bcrypt('252525'),
                'role' => 'Manajer Gudang',
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']], // mencari berdasarkan email
                $userData // data yang akan diinsert jika email belum ada
            );
        }
    }
}

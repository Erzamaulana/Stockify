<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::insert([
            ['key' => 'app_name', 'value' => 'Stockify'],
            ['key' => 'logo', 'value' => 'default-logo.png'],
            ['key' => 'theme', 'value' => 'light'],
            ['key' => 'contact_email', 'value' => 'support@stockify.com'],
        ]);
    }
}

<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    public function getAll()
    {
        // Ambil semua setting sebagai array key => value
        return Setting::pluck('value', 'key')->toArray();
    }

    public function updateSetting(string $key, string $value)
    {
        return Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}

<?php

namespace App\Repositories\Interfaces;

interface SettingRepositoryInterface
{
    public function getAll(); // Mengembalikan array key-value
    public function updateSetting(string $key, string $value);
}

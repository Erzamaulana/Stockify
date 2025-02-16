<?php

namespace App\Services;

use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingService
{
    protected SettingRepositoryInterface $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getAllSettings()
    {
        return $this->settingRepository->getAll();
    }

    public function updateSettings(array $data)
    {
        foreach ($data as $key => $value) {
            // Update atau buat setting baru untuk setiap key
            $this->settingRepository->updateSetting($key, $value);
        }
        return true;
    }
}

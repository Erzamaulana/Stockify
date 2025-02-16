<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use App\Services\SettingService;
use App\Events\ActivityOccurred; // Import event ActivityOccurred

class SettingController extends Controller
{
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    // Menampilkan halaman pengaturan
    public function index()
    {
        $settings = $this->settingService->getAllSettings();
        return view('admin.settings.index', compact('settings'));
    }

    // Memperbarui pengaturan aplikasi
    public function update(Request $request)
    {
        $request->validate([
            'app_name'      => 'required|string|max:255',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'theme'         => 'required|in:light,dark',
            'contact_email' => 'nullable|email',
        ]);

        // Ambil data yang ingin diupdate
        $data = $request->only(['app_name', 'theme', 'contact_email']);

        if ($request->hasFile('logo')) {
            // Simpan file logo ke disk 'public' di folder 'settings'
            $filePath = $request->file('logo')->store('settings', 'public');
            $data['logo'] = $filePath;
        }

        $this->settingService->updateSettings($data);

        // Dispatch event untuk mencatat aktivitas update pengaturan
        event(new ActivityOccurred(
            auth()->id(),
            "Memperbarui Pengaturan Aplikasi",
            "Pengaturan aplikasi telah diperbarui dengan data: " . json_encode($data)
        ));

        return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}

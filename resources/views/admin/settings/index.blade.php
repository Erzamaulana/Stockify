@extends('layouts.app')

@section('title', 'Pengaturan Aplikasi')

@section('content')
<div class="container mx-auto px-4 mt-14">
    <!-- Judul Halaman (Tanpa Dark Mode) -->
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Pengaturan Aplikasi</h2>

    <!-- Form Pengaturan -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <!-- Nama Aplikasi -->
        <div class="mb-4">
            <label for="app_name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Nama Aplikasi</label>
            <input type="text" name="app_name" id="app_name" 
                   value="{{ old('app_name', $settings['app_name'] ?? '') }}" 
                   class="w-full p-2 border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg">
            @error('app_name') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Logo Aplikasi -->
        <div class="mb-4">
            <label for="logo" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Logo Aplikasi</label>
            <input type="file" name="logo" id="logo" 
                   class="w-full p-2 border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg">
            @if(isset($settings['logo']))  
                <div class="mt-2">  
                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="object-contain h-16 w-16">  
                </div>  
            @endif
            @error('logo') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Tema -->
        <div class="mb-4">
            <label for="theme" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Tema</label>
            <select name="theme" id="theme" 
                    class="w-full p-2 border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg">
                <option value="light" {{ old('theme', $settings['theme'] ?? '') == 'light' ? 'selected' : '' }}>Light</option>
                <option value="dark" {{ old('theme', $settings['theme'] ?? '') == 'dark' ? 'selected' : '' }}>Dark</option>
            </select>
            @error('theme') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Email Kontak -->
        <div class="mb-6">
            <label for="contact_email" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Email Kontak</label>
            <input type="email" name="contact_email" id="contact_email" 
                   value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" 
                   class="w-full p-2 border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg">
            @error('contact_email') 
                <p class="text-red-500 text-sm">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" 
                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition 
                       dark:bg-blue-700 dark:hover:bg-blue-800">
            Simpan Pengaturan
        </button>
    </form>
</div>
@endsection
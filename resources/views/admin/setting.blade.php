@extends('admin.layout')

@section('content')
<div class="container mx-auto p-8">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Pengaturan Umum Aplikasi</h1>
        
        <form method="POST" action="#" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Input Nama Aplikasi -->
            <div>
                <label for="app_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Aplikasi</label>
                <input type="text" id="app_name" name="app_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Masukkan nama aplikasi" required>
            </div>
            
            <!-- Input Logo Aplikasi -->
            <div>
                <label for="app_logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo Aplikasi</label>
                <input type="file" id="app_logo" name="app_logo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Unggah logo baru jika ingin mengganti logo aplikasi.</p>
            </div>

            <!-- Preview Logo -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-900 dark:text-white">Preview Logo Saat Ini:</label>
                <div class="mt-2">
                    <img src="{{ asset('path/to/current/logo.png') }}" alt="Logo Saat Ini" class="h-20 w-auto rounded-md border dark:border-gray-700">
                </div>
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

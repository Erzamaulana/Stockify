@extends('layouts.app')

@section('title', 'Import Produk')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 text-blue-500 hover:text-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Judul Halaman -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Import Produk</h1>

    <!-- Form Import Produk -->
    <form action="{{ route('admin.products.import.process') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="file" class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                Pilih File (xlsx, xls, csv):
            </label>
            <input type="file" name="file" id="file" required
                   class="w-full border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
            Import Produk
        </button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Tambah Atribut Produk')

@section('content')
<div class="container mx-auto p-6 mt-6">
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('admin.product_attributes.index') }}" class="inline-flex items-center px-4 py-2 text-blue-500 hover:text-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>
    
    <!-- Judul Halaman (tanpa dark mode override) -->
    <h2 class="text-xl font-semibold mb-4 text-gray-900">Tambah Atribut Produk</h2>

    <form action="{{ route('admin.product_attributes.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf

        <!-- Pilih Produk -->
        <div class="mb-4">
            <label for="product_id" class="block font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Produk</label>
            <select name="product_id" id="product_id" required
                    class="w-full border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nama Atribut -->
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700 dark:text-gray-300 mb-2">Nama Atribut</label>
            <input type="text" name="name" id="name" required placeholder="Masukkan nama atribut"
                   class="w-full border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        </div>

        <!-- Nilai Atribut -->
        <div class="mb-4">
            <label for="value" class="block font-medium text-gray-700 dark:text-gray-300 mb-2">Nilai Atribut</label>
            <input type="text" name="value" id="value" required placeholder="Masukkan nilai atribut"
                   class="w-full border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
            Simpan
        </button>
    </form>
</div>
@endsection

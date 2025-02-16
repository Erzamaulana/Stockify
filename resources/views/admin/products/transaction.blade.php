@extends('layouts.app')

@section('title', 'Transaksi Produk - ' . ucfirst($type))

@section('content')
<div class="container mx-auto p-6 mt-14">
    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Judul Halaman (Tanpa Dark Mode) -->
    <h1 class="text-3xl font-bold mb-6 text-gray-900">Transaksi Produk: Barang {{ ucfirst($type) }}</h1>

    <!-- Form Transaksi -->
    <form id="transactionForm" action="{{ route('admin.products.transaction.store', $type) }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        @csrf

        <!-- Field Produk -->
        <div class="mb-4">
            <label for="product_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Produk</label>
            <select name="product_id" id="product_id" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (SKU: {{ $product->sku }})</option>
                @endforeach
            </select>
            @error('product_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Field Jumlah -->
        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Jumlah</label>
            <input type="number" name="quantity" id="quantity" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan jumlah" min="1">
            @error('quantity')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Field Catatan -->
        <div class="mb-6">
            <label for="notes" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Catatan</label>
            <textarea name="notes" id="notes" class="w-full p-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Masukkan catatan (opsional)"></textarea>
            @error('notes')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
            Simpan Transaksi
        </button>
    </form>
</div>
@endsection
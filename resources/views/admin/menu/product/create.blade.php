@extends('admin.layout')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Tambah Produk Baru</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Kategori -->
            <div class="space-y-2">
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                <select name="category_id" id="category_id" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" class="dark:text-gray-400">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" class="dark:text-gray-300">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Supplier -->
            <div class="space-y-2">
                <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" class="dark:text-gray-400">Pilih Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" class="dark:text-gray-300">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Produk -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Produk</label>
                <input type="text" name="name" id="name" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400" required>
            </div>

            <!-- SKU -->
            <div class="space-y-2">
                <label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SKU</label>
                <input type="text" name="sku" id="sku" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400" required>
            </div>

            <!-- Harga Beli -->
            <div class="space-y-2">
                <label for="purchase_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Beli</label>
                <input type="number" name="purchase_price" id="purchase_price" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400" required>
            </div>

            <!-- Harga Jual -->
            <div class="space-y-2">
                <label for="selling_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Jual</label>
                <input type="number" name="selling_price" id="selling_price" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400" required>
            </div>

            <!-- Gambar -->
            <div class="space-y-2 md:col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Produk</label>
                <input type="file" name="image" id="image" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-300">
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2 md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400"></textarea>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 dark:bg-blue-700 dark:hover:bg-blue-800">
                <i class="fas fa-save mr-2"></i>Simpan Produk
            </button>
        </div>
    </form>
</div>
@endsection

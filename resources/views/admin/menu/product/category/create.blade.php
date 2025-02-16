@extends('admin.layout')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Tambah Kategori Baru</h2>

    <form action="{{ route('admin.menu.product.category.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            <!-- Nama Kategori -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kategori</label>
                <input type="text" name="name" id="name"
                    class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400"
                    placeholder="Masukkan nama kategori" required>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400"
                    placeholder="Masukkan deskripsi kategori"></textarea>
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200 dark:bg-green-700 dark:hover:bg-green-800">
                <i class="fas fa-save mr-2"></i>Simpan Kategori
            </button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mx-auto py-8 mt-14">
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
    <h1 class="text-3xl font-bold mb-6 text-gray-900">Tambah Produk</h1>

    <!-- Form Tambah Produk -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        @csrf

        <!-- Field Nama Produk -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-300">Nama Produk</label>
            <input type="text" id="name" name="name" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('name') }}">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Field SKU -->
        <div class="mb-4">
            <label for="sku" class="block text-gray-700 dark:text-gray-300">SKU</label>
            <input type="text" id="sku" name="sku" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('sku') }}">
            @error('sku') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Field Harga Beli -->
        <div class="mb-4">
            <label for="purchase_price" class="block text-gray-700 dark:text-gray-300">Harga Beli</label>
            <input type="text" id="purchase_price" name="purchase_price" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('purchase_price') }}">
            @error('purchase_price') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Field Harga Jual -->
        <div class="mb-4">
            <label for="selling_price" class="block text-gray-700 dark:text-gray-300">Harga Jual</label>
            <input type="text" id="selling_price" name="selling_price" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('selling_price') }}">
            @error('selling_price') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Field Kategori -->
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 dark:text-gray-300">Kategori</label>
            <select id="category_id" name="category_id" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Field Supplier -->
        <div class="mb-4">
            <label for="supplier_id" class="block text-gray-700 dark:text-gray-300">Supplier</label>
            <select id="supplier_id" name="supplier_id" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Pilih Supplier</option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
                @endforeach
            </select>
            @error('supplier_id') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Field Deskripsi -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 dark:text-gray-300">Deskripsi</label>
            <textarea id="description" name="description" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
        </div>

        <!-- Field Gambar -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 dark:text-gray-300">Gambar</label>
            <input type="file" id="image" name="image" class="w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700">
            Simpan Produk
        </button>
    </form>
</div>

@push('scripts')
<script>
    // Handling Success Message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    @endif

    // Handling Error Message
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    @endif

    // Handling Info Message
    @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: "{{ session('info') }}",
            showConfirmButton: true
        });
    @endif
</script>
@endpush
@endsection
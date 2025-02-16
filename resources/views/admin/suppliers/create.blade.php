@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('admin.suppliers.index') }}" class="inline-flex items-center px-4 py-2 text-blue-500 hover:text-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>
    <!-- Judul Halaman (tanpa dark mode override) -->
    <h1 class="text-3xl font-bold mb-6 text-gray-900">Tambah Supplier</h1>
    <form action="{{ route('admin.suppliers.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-300">Nama Supplier</label>
            <input type="text" name="name" id="name" class="w-full border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" placeholder="Nama Supplier" value="{{ old('name') }}" required>
            @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="mb-4">
            <label for="address" class="block text-gray-700 dark:text-gray-300">Alamat</label>
            <textarea name="address" id="address" class="w-full border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" placeholder="Alamat Supplier">{{ old('address') }}</textarea>
            @error('address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 dark:text-gray-300">Telepon</label>
            <input type="text" name="phone" id="phone" class="w-full border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" placeholder="Nomor Telepon" value="{{ old('phone') }}">
            @error('phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" placeholder="Email Supplier" value="{{ old('email') }}" required>
            @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
            Simpan Supplier
        </button>
    </form>
</div>
@endsection

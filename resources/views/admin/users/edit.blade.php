@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Judul Halaman -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Pengguna</h1>

    <!-- Form Edit -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')
        
        <!-- Field Nama -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-300 mb-2">Nama</label>
            <input type="text" name="name" id="name" 
                   class="w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5" 
                   placeholder="Nama pengguna" 
                   value="{{ old('name', $user->name) }}" 
                   required>
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Field Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
            <input type="email" name="email" id="email" 
                   class="w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5" 
                   placeholder="Email pengguna" 
                   value="{{ old('email', $user->email) }}" 
                   required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Field Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 dark:text-gray-300 mb-2">Password</label>
            <input type="password" name="password" id="password" 
                   class="w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5" 
                   placeholder="Password baru (kosongkan jika tidak diubah)">
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Field Konfirmasi Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                   class="w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5" 
                   placeholder="Konfirmasi Password baru">
        </div>

        <!-- Field Role -->
        <div class="mb-6">
            <label for="role" class="block text-gray-700 dark:text-gray-300 mb-2">Role</label>
            <select name="role" id="role" 
                    class="w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg p-2.5" 
                    required>
                <option value="">-- Pilih Role --</option>
                <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }} class="dark:bg-gray-700">Admin</option>
                <option value="Manajer Gudang" {{ old('role', $user->role) == 'Manajer Gudang' ? 'selected' : '' }} class="dark:bg-gray-700">Manajer Gudang</option>
                <option value="Staff Gudang" {{ old('role', $user->role) == 'Staff Gudang' ? 'selected' : '' }} class="dark:bg-gray-700">Staff Gudang</option>
            </select>
            @error('role')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tombol Submit -->
        <button type="submit" 
                class="bg-blue-500 text-white px-5 py-2.5 rounded-lg hover:bg-blue-600 transition 
                       dark:bg-blue-600 dark:hover:bg-blue-700">
            Perbarui Pengguna
        </button>
    </form>
</div>
@endsection
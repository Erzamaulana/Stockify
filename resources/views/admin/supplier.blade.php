@extends('admin.layout')

@section('content')
<div class="p-6 w-full min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Header -->
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Manajemen Data Supplier</h1>

    <!-- Tabel Data Supplier -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden mb-6">
        <table class="table-auto w-full text-left">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">No</th>
                    <th class="py-3 px-6">Nama Supplier</th>
                    <th class="py-3 px-6">Alamat</th>
                    <th class="py-3 px-6">Kontak</th>
                    <th class="py-3 px-6">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-300 text-sm">
                <!-- Contoh Data -->
                <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-600">
                    <td class="py-3 px-6">1</td>
                    <td class="py-3 px-6">PT Sumber Jaya</td>
                    <td class="py-3 px-6">Jl. Merdeka No. 10</td>
                    <td class="py-3 px-6">081234567890</td>
                    <td class="py-3 px-6">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 dark:hover:bg-blue-400">Edit</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 dark:hover:bg-red-400">Hapus</button>
                    </td>
                </tr>
                <!-- Tambahkan baris data lainnya di sini -->
            </tbody>
        </table>
    </div>

    <!-- Form Tambah Supplier -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Tambah Supplier Baru</h2>
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Supplier -->
                <div>
                    <label for="nama_supplier" class="block text-gray-600 dark:text-gray-300 mb-1">Nama Supplier</label>
                    <input type="text" id="nama_supplier" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-gray-600 dark:text-gray-300 mb-1">Alamat</label>
                    <input type="text" id="alamat" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <!-- Kontak -->
                <div>
                    <label for="kontak" class="block text-gray-600 dark:text-gray-300 mb-1">Kontak</label>
                    <input type="text" id="kontak" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <!-- Informasi Lainnya -->
                <div>
                    <label for="info_lainnya" class="block text-gray-600 dark:text-gray-300 mb-1">Informasi Lainnya</label>
                    <input type="text" id="info_lainnya" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
            </div>
            <!-- Tombol Submit -->
            <div class="mt-4">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 dark:hover:bg-green-400">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

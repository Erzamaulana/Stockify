@extends('admin.layout')

@section('content')
<div class="p-6 w-full min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Header -->
    <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Manajemen Data Pengguna</h1>

    <!-- Tabel Data Pengguna -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden mb-6">
        <table class="table-auto w-full text-left">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">No</th>
                    <th class="py-3 px-6">Nama Pengguna</th>
                    <th class="py-3 px-6">Email</th>
                    <th class="py-3 px-6">Role</th>
                    <th class="py-3 px-6">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-300 text-sm">
                <!-- Contoh Data -->
                <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-600">
                    <td class="py-3 px-6">1</td>
                    <td class="py-3 px-6">John Doe</td>
                    <td class="py-3 px-6">john.doe@example.com</td>
                    <td class="py-3 px-6">Admin</td>
                    <td class="py-3 px-6">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 dark:hover:bg-blue-400">Edit</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 dark:hover:bg-red-400">Hapus</button>
                    </td>
                </tr>
                <!-- Tambahkan baris data lainnya di sini -->
            </tbody>
        </table>
    </div>

    <!-- Form Tambah Pengguna -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Tambah Pengguna Baru</h2>
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Pengguna -->
                <div>
                    <label for="nama_pengguna" class="block text-gray-600 dark:text-gray-300 mb-1">Nama Pengguna</label>
                    <input type="text" id="nama_pengguna" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-600 dark:text-gray-300 mb-1">Email</label>
                    <input type="email" id="email" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                </div>
                <!-- Role -->
                <div>
                    <label for="role" class="block text-gray-600 dark:text-gray-300 mb-1">Role</label>
                    <select id="role" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
                        <option value="Admin">Admin</option>
                        <option value="Manajer Gudang">Manajer Gudang</option>
                        <option value="Staff Gudang">Staff Gudang</option>
                    </select>
                </div>
                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-600 dark:text-gray-300 mb-1">Password</label>
                    <input type="password" id="password" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
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

@extends('admin.layout')

@section('content')
<div class="p-6 w-full min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Card Statistics -->
    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Total Stok</h2>
            <p class="text-4xl font-bold text-gray-800 dark:text-gray-200">15,340</p>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Semua produk</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Stok Minimum</h2>
            <p class="text-4xl font-bold text-red-600 dark:text-red-400">8</p>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Produk dibawah batas minimum</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Transaksi Hari Ini</h2>
            <p class="text-4xl font-bold text-gray-800 dark:text-gray-200">24</p>
            <p class="text-gray-500 dark:text-gray-400 text-sm">12 masuk - 12 keluar</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Transaction History (spans 2 columns) -->
        <div class="col-span-2 space-y-6">
            <!-- Stock Transactions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Riwayat Transaksi</h2>
                    <div class="space-x-3">
                        <button class="bg-blue-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-600 dark:hover:bg-blue-400">
                            + Stok Masuk
                        </button>
                        <button class="bg-green-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-600 dark:hover:bg-green-400">
                            - Stok Keluar
                        </button>
                    </div>
                </div>

                <!-- Filter and Search -->
                <div class="flex gap-4 mb-6">
                    <input type="text" placeholder="Cari transaksi..." 
                           class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                        <option value="">Semua Tipe</option>
                        <option value="in">Stok Masuk</option>
                        <option value="out">Stok Keluar</option>
                    </select>
                    <input type="date" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                </div>

                <!-- Transactions Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">2024-03-19</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                        Masuk
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">Produk A</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">+50</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">Restok gudang</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">2024-03-19</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                        Keluar
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">Produk B</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">-20</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">Pengiriman ke toko</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex justify-between items-center mt-4">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        Showing 1 to 10 of 50 entries
                    </div>
                    <div class="space-x-2">
                        <button class="px-3 py-1 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600 dark:text-gray-200">Previous</button>
                        <button class="px-3 py-1 border rounded-lg bg-blue-500 text-white">1</button>
                        <button class="px-3 py-1 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600 dark:text-gray-200">2</button>
                        <button class="px-3 py-1 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600 dark:text-gray-200">3</button>
                        <button class="px-3 py-1 border rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600 dark:text-gray-200">Next</button>
                    </div>
                </div>
            </div>

            <!-- Stock Opname -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Stock Opname</h2>
                    <button class="bg-indigo-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-indigo-600 dark:hover:bg-indigo-400">
                        + Stock Opname Baru
                    </button>
                </div>

                <!-- Stock Opname Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Petugas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Selisih</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">2024-03-18</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">Selesai</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">John Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap text-red-600 dark:text-red-400">-15</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 dark:hover:bg-green-400">Detail</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">2024-03-17</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">Draft</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">Jane Smith</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-600 dark:text-green-400">+5</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 dark:hover:bg-yellow-400">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Product Statistics -->
        <div class="space-y-6">
            <!-- Lowest Stock -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Stok Terendah</h2>
                <ul class="space-y-4">
                    <li class="flex justify-between items-center">
                        <span class="text-gray-800 dark:text-gray-200">Produk A</span>
                        <span class="text-red-600 dark:text-red-400">5</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="text-gray-800 dark:text-gray-200">Produk B</span>
                        <span class="text-red-600 dark:text-red-400">8</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="text-gray-800 dark:text-gray-200">Produk C</span>
                        <span class="text-red-600 dark:text-red-400">12</span>
                    </li>
                </ul>
            </div>

            <!-- Highest Stock -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Stok Tertinggi</h2>
                <ul class="space-y-4">
                    <li class="flex justify-between items-center">
                        <span class="text-gray-800 dark:text-gray-200">Produk X</span>
                        <span class="text-green-600 dark:text-green-400">250</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="text-gray-800 dark:text-gray-200">Produk Y</span>
                        <span class="text-green-600 dark:text-green-400">200</span>
                    </li>
                    <li class="flex justify-between items-center">
                        <span class="text-gray-800 dark:text-gray-200">Produk Z</span>
                        <span class="text-green-600 dark:text-green-400">180</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
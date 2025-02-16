@extends('staff.layout')
@section('content-staff')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Dashboard Staff Gudang</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Selamat datang di panel kontrol staff gudang</p>
    </div>

    <!-- Task Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Pending Incoming Items -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 dark:text-gray-400">Barang Masuk</h2>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">15</p>
                </div>
            </div>
        </div>

        <!-- Pending Outgoing Items -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 dark:text-gray-400">Barang Keluar</h2>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">8</p>
                </div>
            </div>
        </div>

        <!-- Stock Opname Tasks -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 dark:text-gray-400">Stock Opname</h2>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">2</p>
                </div>
            </div>
        </div>

        <!-- Total Tasks -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600 dark:text-gray-400">Total Tugas</h2>
                    <p class="text-2xl font-semibold text-gray-800 dark:text-gray-100">25</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Lists -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Incoming Items Tasks -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Daftar Barang Masuk</h2>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div>
                            <h3 class="font-medium text-gray-800 dark:text-gray-100">Pemeriksaan Barang dari Supplier A</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">10 item perlu diperiksa</p>
                        </div>
                        <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100">Menunggu</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div>
                            <h3 class="font-medium text-gray-800 dark:text-gray-100">Verifikasi Pengiriman B</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">5 item perlu diverifikasi</p>
                        </div>
                        <span class="px-3 py-1 text-sm rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100">Proses</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Outgoing Items Tasks -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Daftar Barang Keluar</h2>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div>
                            <h3 class="font-medium text-gray-800 dark:text-gray-100">Persiapan Pengiriman ke Cabang X</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">8 item perlu disiapkan</p>
                        </div>
                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100">Siap Kirim</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div>
                            <h3 class="font-medium text-gray-800 dark:text-gray-100">Pengiriman ke Customer Y</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">3 item menunggu pickup</p>
                        </div>
                        <span class="px-3 py-1 text-sm rounded-full bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-100">Menunggu Pickup</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
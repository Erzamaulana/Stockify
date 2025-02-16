@extends('layouts.app')

@section('title', 'Riwayat Transaksi Stok')

@section('content')
<div class="container mx-auto py-8">
    <!-- Judul Halaman -->
    <h1 class="text-3xl font-bold text-gray-900 mt-8 mb-8">
        Riwayat Transaksi Stok
    </h1>

    <!-- Wrapper Tabel Riwayat Transaksi -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="w-full table-fixed border-collapse text-sm text-left text-gray-700 dark:text-gray-200">
            <!-- Header Tabel -->
            <thead class="bg-gray-200 dark:bg-gray-700 uppercase text-xs">
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    <th scope="col" class="px-4 py-3 border-r border-gray-200 dark:border-gray-600 w-1/6">
                        Tanggal
                    </th>
                    <th scope="col" class="px-4 py-3 border-r border-gray-200 dark:border-gray-600 w-1/6">
                        Tipe
                    </th>
                    <th scope="col" class="px-4 py-3 border-r border-gray-200 dark:border-gray-600 w-1/6">
                        Produk
                    </th>
                    <th scope="col" class="px-4 py-3 border-r border-gray-200 dark:border-gray-600 w-1/6">
                        Jumlah
                    </th>
                    <th scope="col" class="px-4 py-3 border-r border-gray-200 dark:border-gray-600 w-1/6">
                        User
                    </th>
                    <th scope="col" class="px-4 py-3 w-1/6">
                        Keterangan
                    </th>
                </tr>
            </thead>
            <!-- Body Tabel -->
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <!-- Tanggal -->
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y H:i') }}
                        </td>
                        <!-- Tipe -->
                        <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">
                            @if(strtolower($transaction->type) === 'masuk')
                                <span class="inline-flex items-center rounded-full
                                             bg-green-200 dark:bg-green-800
                                             text-green-800 dark:text-green-200
                                             px-2 py-1">
                                    <!-- Simbol bulat kecil -->
                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Masuk
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full
                                             bg-red-200 dark:bg-red-800
                                             text-red-800 dark:text-red-200
                                             px-2 py-1">
                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Keluar
                                </span>
                            @endif
                        </td>
                        <!-- Produk -->
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ $transaction->product->name }}
                        </td>
                        <!-- Jumlah -->
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ $transaction->quantity }}
                        </td>
                        <!-- User -->
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ $transaction->user->name }}
                        </td>
                        <!-- Keterangan -->
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">
                            {{ $transaction->notes }}
                        </td>
                    </tr>
                @empty
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                            Tidak ada transaksi stok.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <!-- Stock Opname -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Stock Opname
        </h2>
        <p class="text-gray-700 dark:text-gray-300">
            Fitur untuk mencatat ulang stok di gudang.
        </p>
        <a href="{{ route('admin.stock.opname') }}" class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 text-white px-4 py-2 rounded">
            Lihat Stock Opname
        </a>
    </div>

    <!-- Pengaturan Stok Minimum -->
    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Pengaturan Stok Minimum
        </h2>
        <p class="text-gray-700 dark:text-gray-300">
            Atur jumlah minimum stok untuk notifikasi.
        </p>
        <a href="{{ route('admin.stock.settings') }}" class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 text-white px-4 py-2 rounded">
            Atur Stok Minimum
        </a>
    </div>
</div>
@endsection

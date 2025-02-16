@extends('layouts.app')

@section('title', 'Stock Opname')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('admin.stock.index') }}" class="inline-flex items-center px-4 py-2 text-blue-500 hover:text-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>

    <!-- Judul Halaman -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">
        Stock Opname
    </h1>

    <!-- Tabel Stock Opname -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="w-full table-auto border-collapse text-sm">
            <thead class="bg-gray-200 dark:bg-gray-700 uppercase text-xs text-gray-700 dark:text-gray-200">
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600 w-1/4">Produk</th>
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600 w-1/4">Stok Sistem</th>
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600 w-1/4">Stok Fisik</th>
                    <th class="px-4 py-3 w-1/4">Selisih</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                @forelse($stockOpnameData as $data)
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ $data['product'] }}
                        </td>
                        <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ $data['system_stock'] }}
                        </td>
                        <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                            {{ $data['physical_stock'] }}
                        </td>
                        <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-100">
                            {{ $data['difference'] }}
                        </td>
                    </tr>
                @empty
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td colspan="4" class="text-center p-4 text-gray-500 dark:text-gray-400">
                            Tidak ada data stock opname.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

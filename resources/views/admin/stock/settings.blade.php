@extends('layouts.app')

@section('title', 'Pengaturan Stok Minimum')

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
        Pengaturan Stok Minimum
    </h1>
    
    <!-- Tabel Produk -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="min-w-full table-auto border-collapse text-sm">
            <thead class="bg-gray-200 dark:bg-gray-700 uppercase text-xs text-gray-700 dark:text-gray-200">
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">Produk</th>
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">Stok Saat Ini</th>
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">Stok Minimum</th>
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                @foreach($products as $product)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                        {{ $product->name }}
                    </td>
                    <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                        {{ $product->stock }}
                    </td>
                    <td class="px-4 py-3 text-center text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                        {{ $product->min_stock }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($product->stock < $product->min_stock)
                            <span class="text-red-500 font-bold">Kurang</span>
                        @else
                            <span class="text-green-500 font-bold">Cukup</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <!-- Tombol Atur memicu modal -->
                        <button type="button"
                                data-modal-target="edit-minimum-modal-{{ $product->id }}"
                                data-modal-toggle="edit-minimum-modal-{{ $product->id }}"
                                class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded shadow">
                            Atur
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk setiap produk (Atur Stok Minimum) -->
@foreach($products as $product)
<div id="edit-minimum-modal-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed top-16 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-y-auto">
    <div class="relative w-full max-w-md">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-600 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Atur Stok Minimum - {{ $product->name }}
                </h3>
                <button type="button" data-modal-toggle="edit-minimum-modal-{{ $product->id }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4">
            <form action="{{ route('admin.stock.settings.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="min_stock-{{ $product->id }}" class="block text-gray-700 dark:text-gray-300 mb-2">Stok Minimum</label>
    <input id="min_stock-{{ $product->id }}" name="min_stock" type="number" value="{{ $product->min_stock }}" required
           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring dark:bg-gray-600 dark:text-white">
    <div class="mt-4 flex justify-end">
        <button type="button" data-modal-toggle="edit-minimum-modal-{{ $product->id }}" class="px-4 py-2 bg-gray-200 text-gray-900 rounded hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-100 dark:hover:bg-gray-500 mr-2">
            Batal
        </button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
            Simpan
        </button>
    </div>
</form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

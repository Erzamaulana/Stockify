@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto py-8">
    <!-- Baris: Judul di kiri, Tombol Toggle di kanan -->
    <div class="flex items-center justify-between mt-8 mb-6">
        <h1 class="text-3xl font-bold text-gray-900">
            Manajemen Produk
        </h1>
        <!-- Tombol Toggle Modal di sisi kanan -->
        <div class="flex flex-wrap gap-4">
            <button
                data-modal-target="modal-manajemen-data"
                data-modal-toggle="modal-manajemen-data"
                type="button"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                       focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                       dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Manajemen Data
            </button>
            <button
                data-modal-target="modal-manajemen-trans"
                data-modal-toggle="modal-manajemen-trans"
                type="button"
                class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none
                       focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                       dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Manajemen Transactional
            </button>
        </div>
    </div>

    <!-- Tabel Daftar Produk -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    <th class="px-4 py-2 text-left border-r border-gray-200 dark:border-gray-600">SKU</th>
                    <th class="px-4 py-2 text-left border-r border-gray-200 dark:border-gray-600">Nama</th>
                    <th class="px-4 py-2 text-left border-r border-gray-200 dark:border-gray-600">Harga Jual</th>
                    <th class="px-4 py-2 text-left border-r border-gray-200 dark:border-gray-600">Kategori</th>
                    <th class="px-4 py-2 text-left border-r border-gray-200 dark:border-gray-600">Atribut</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                @foreach($products as $product)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                        {{ $product->sku }}
                    </td>
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                        {{ $product->name }}
                    </td>
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                        {{ number_format($product->selling_price, 2) }}
                    </td>
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                        {{ $product->category->name }}
                    </td>
                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100 border-r border-gray-200 dark:border-gray-600">
                        @if($product->attributes && count($product->attributes) > 0)
                            @foreach($product->attributes as $attribute)
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $attribute->name }}: {{ $attribute->value }}
                                </div>
                            @endforeach
                        @else
                            <span class="text-gray-500 dark:text-gray-400">Tidak ada atribut.</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-center text-gray-900 dark:text-gray-100">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="text-blue-500 hover:underline">
                            Edit
                        </a>
                        <button type="button"
                                data-modal-target="flowbite-delete-modal-{{ $product->id }}"
                                data-modal-toggle="flowbite-delete-modal-{{ $product->id }}"
                                class="text-red-500 hover:underline ml-2">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>

<!-- Modal #1: Manajemen Data -->
<div id="modal-manajemen-data"
     tabindex="-1"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-16 right-0 left-0 z-50 justify-center items-center
            w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Manajemen Data
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center
                               dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modal-manajemen-data">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <p class="text-gray-500 dark:text-gray-400 mb-4">
                    Pilih salah satu menu manajemen data:
                </p>
                <ul class="space-y-4 mb-4">
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                           class="inline-flex items-center justify-between w-full p-5 text-gray-900 dark:text-white bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg
                                  cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-500 dark:hover:text-gray-300">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Kategori</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">Kelola kategori produk</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400"
                                 fill="none" stroke="currentColor" viewBox="0 0 14 10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product_attributes.index') }}"
                           class="inline-flex items-center justify-between w-full p-5 text-gray-900 dark:text-white bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg
                                  cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-500 dark:hover:text-gray-300">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Atribut Produk</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">Tambah atau atur atribut produk</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400"
                                 fill="none" stroke="currentColor" viewBox="0 0 14 10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.import') }}"
                           class="inline-flex items-center justify-between w-full p-5 text-gray-900 dark:text-white bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg
                                  cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-500 dark:hover:text-gray-300">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Import</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">Impor data produk dari file</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400"
                                 fill="none" stroke="currentColor" viewBox="0 0 14 10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.export') }}"
                           class="inline-flex items-center justify-between w-full p-5 text-gray-900 dark:text-white bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg
                                  cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-500 dark:hover:text-gray-300">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Export</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">Ekspor data produk ke file</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400"
                                 fill="none" stroke="currentColor" viewBox="0 0 14 10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal #2: Manajemen Transactional -->
<div id="modal-manajemen-trans"
     tabindex="-1"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-16 right-0 left-0 z-50 justify-center items-center
            w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Manajemen Transactional
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center
                               dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="modal-manajemen-trans">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <p class="text-gray-500 dark:text-gray-400 mb-4">
                    Pilih salah satu menu manajemen transaksi:
                </p>
                <ul class="space-y-4 mb-4">
                    <li>
                        <a href="{{ route('admin.products.transaction.create', 'Masuk') }}"
                           class="inline-flex items-center justify-between w-full p-5 text-gray-900 dark:text-white bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg
                                  cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-500 dark:hover:text-gray-300">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Barang Masuk</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">Transaksi penambahan stok</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400"
                                 fill="none" stroke="currentColor" viewBox="0 0 14 10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.transaction.create', 'Keluar') }}"
                           class="inline-flex items-center justify-between w-full p-5 text-gray-900 dark:text-white bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg
                                  cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-500 dark:hover:text-gray-300">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Barang Keluar</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">Transaksi pengurangan stok</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400"
                                 fill="none" stroke="currentColor" viewBox="0 0 14 10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}"
                           class="inline-flex items-center justify-between w-full p-5 text-gray-900 dark:text-white bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-lg
                                  cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-500 dark:hover:text-gray-300">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Produk</div>
                                <div class="w-full text-gray-500 dark:text-gray-400">Tambah produk baru</div>
                            </div>
                            <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500 dark:text-gray-400"
                                 fill="none" stroke="currentColor" viewBox="0 0 14 10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Flowbite Modal Delete (satu modal per produk) -->
@foreach($products as $product)
<div id="flowbite-delete-modal-{{ $product->id }}"
     tabindex="-1"
     class="hidden fixed top-16 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto
            md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">

    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b dark:border-gray-600 border-gray-200 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Hapus Produk?
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center
                               dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="flowbite-delete-modal-{{ $product->id }}">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <p class="text-gray-500 dark:text-gray-400 mb-4">
                    Apakah Anda yakin ingin menghapus produk <strong>{{ $product->name }}</strong>?
                </p>
                <div class="flex justify-end space-x-2">
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="flowbite-delete-modal-{{ $product->id }}"
                                type="submit"
                                class="px-5 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Ya, hapus
                        </button>
                    </form>
                    <button data-modal-hide="flowbite-delete-modal-{{ $product->id }}"
                            type="button"
                            class="px-5 py-2 bg-gray-200 text-gray-900 rounded hover:bg-gray-300
                                   dark:bg-gray-600 dark:text-gray-100 dark:hover:bg-gray-500">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
    // Handling SweetAlert messages untuk success, error, dan info
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    @endif

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

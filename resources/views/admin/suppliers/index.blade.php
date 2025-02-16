@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <!-- Judul Halaman -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Daftar Supplier</h1>
    
    <!-- Tombol Tambah Supplier -->
    <div class="mb-4">
        <a href="{{ route('admin.suppliers.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
            Tambah Supplier
        </a>
    </div>
    
    <!-- Tabel Data Supplier -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="min-w-full table-auto border-collapse text-sm">
            <thead class="bg-gray-200 dark:bg-gray-700 uppercase text-xs text-gray-700 dark:text-gray-200">
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">Nama</th>
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">Alamat</th>
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">Telepon</th>
                    <th class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">Email</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-600 text-gray-900 dark:text-gray-100">
                @foreach($suppliers as $supplier)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">{{ $supplier->name }}</td>
                    <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">{{ $supplier->address }}</td>
                    <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">{{ $supplier->phone }}</td>
                    <td class="px-4 py-3 border-r border-gray-200 dark:border-gray-600">{{ $supplier->email }}</td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="text-blue-500 hover:underline">
                            Edit
                        </a>
                        <button type="button"
                                data-modal-target="flowbite-delete-modal-{{ $supplier->id }}"
                                data-modal-toggle="flowbite-delete-modal-{{ $supplier->id }}"
                                class="text-red-500 hover:underline">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Hapus Supplier -->
@foreach($suppliers as $supplier)
<div id="flowbite-delete-modal-{{ $supplier->id }}"
     tabindex="-1"
     class="hidden fixed top-16 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto
            md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">

    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b dark:border-gray-600 border-gray-200 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Hapus Supplier?
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center
                               dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="flowbite-delete-modal-{{ $supplier->id }}">
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
                    Apakah Anda yakin ingin menghapus supplier <strong>{{ $supplier->name }}</strong>?
                </p>
                <div class="flex justify-end space-x-2">
                    <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="flowbite-delete-modal-{{ $supplier->id }}"
                                type="submit"
                                class="px-5 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Ya, hapus
                        </button>
                    </form>
                    <button data-modal-hide="flowbite-delete-modal-{{ $supplier->id }}"
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
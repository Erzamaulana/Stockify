@extends('layouts.app')

@section('title', 'Daftar Atribut Produk')

@section('content')
<div class="container mx-auto p-6 mt-6">
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 text-blue-500 hover:text-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
    </div>
    <!-- Judul Halaman -->
    <h2 class="text-2xl font-semibold text-gray-900 mb-4">Daftar Atribut Produk</h2>
    
    <!-- Tombol Tambah Atribut -->
    <div class="mb-4">
        <a href="{{ route('admin.product_attributes.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
            Tambah Atribut
        </a>
    </div>
    
    <!-- Tabel Atribut Produk -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="min-w-full table-auto border-collapse text-sm">
            <thead class="bg-gray-200 dark:bg-gray-700 uppercase text-xs text-gray-700 dark:text-gray-200">
                <tr class="border-b border-gray-200 dark:border-gray-600">
                    <th class="border p-3">No</th>
                    <th class="border p-3">Nama Atribut</th>
                    <th class="border p-3">Nilai</th>
                    <th class="border p-3">Produk</th>
                    <th class="border p-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-900 dark:text-gray-100">
                @foreach ($attributes as $index => $attribute)
                <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="border p-3 text-center">{{ $index + 1 }}</td>
                    <td class="border p-3">{{ $attribute->name }}</td>
                    <td class="border p-3">{{ $attribute->value }}</td>
                    <td class="border p-3">{{ $attribute->product->name ?? '-' }}</td>
                    <td class="border p-3 text-center">
                        <a href="{{ route('admin.product_attributes.edit', $attribute->id) }}" class="text-blue-500 hover:underline">
                            Edit
                        </a>
                        <button type="button" 
                                data-modal-target="delete-attribute-modal-{{ $attribute->id }}" 
                                data-modal-toggle="delete-attribute-modal-{{ $attribute->id }}"
                                class="text-red-500 hover:underline ml-2">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Delete untuk setiap atribut -->
@foreach($attributes as $attribute)
<div id="delete-attribute-modal-{{ $attribute->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed top-16 left-0 right-0 z-50 flex justify-center items-center w-full p-4 overflow-y-auto">
    <div class="relative w-full max-w-md">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b dark:border-gray-600 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Hapus Atribut
                </h3>
                <button type="button" data-modal-toggle="delete-attribute-modal-{{ $attribute->id }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4">
                <p class="text-gray-500 dark:text-gray-400 mb-4">
                    Apakah Anda yakin ingin menghapus atribut <strong>{{ $attribute->name }}</strong>?
                </p>
                <div class="flex justify-end space-x-2">
                    <form action="{{ route('admin.product_attributes.destroy', $attribute->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" data-modal-hide="delete-attribute-modal-{{ $attribute->id }}" class="px-5 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Ya, hapus
                        </button>
                    </form>
                    <button type="button" data-modal-toggle="delete-attribute-modal-{{ $attribute->id }}" class="px-5 py-2 bg-gray-200 text-gray-900 rounded hover:bg-gray-300 dark:bg-gray-600 dark:text-gray-100 dark:hover:bg-gray-500">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
    // Handling SweetAlert notifications
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
@endsection

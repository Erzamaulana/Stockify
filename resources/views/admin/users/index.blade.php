@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <!-- Judul Halaman -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Daftar Pengguna</h1>

    <!-- Tombol Tambah Pengguna -->
    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
        Tambah Pengguna
    </a>

    <!-- Tabel Data Pengguna -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg mt-6">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600">Nama</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600">Email</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600">Role</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-900 dark:text-gray-100">
                @forelse($users as $user)
                <tr class="border-t border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600">{{ $user->name }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600">{{ $user->email }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600">{{ $user->role }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-center space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:underline">
                            Edit
                        </a>
                        <button type="button"
                                data-modal-target="flowbite-delete-modal-{{ $user->id }}"
                                data-modal-toggle="flowbite-delete-modal-{{ $user->id }}"
                                class="text-red-500 hover:underline">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada pengguna ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Hapus Pengguna -->
@foreach($users as $user)
<div id="flowbite-delete-modal-{{ $user->id }}"
     tabindex="-1"
     class="hidden fixed top-16 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto
            md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center">

    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-sm">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b dark:border-gray-600 border-gray-200 rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Hapus Pengguna?
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center
                               dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="flowbite-delete-modal-{{ $user->id }}">
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
                    Apakah Anda yakin ingin menghapus pengguna <strong>{{ $user->name }}</strong>?
                </p>
                <div class="flex justify-end space-x-2">
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button data-modal-hide="flowbite-delete-modal-{{ $user->id }}"
                                type="submit"
                                class="px-5 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Ya, hapus
                        </button>
                    </form>
                    <button data-modal-hide="flowbite-delete-modal-{{ $user->id }}"
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
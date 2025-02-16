@extends('admin.layout')

@section('content')
<div class="container mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Edit Kategori</h1>
    <form action="{{ route('admin.menu.product.category.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-300">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}"
                class="border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900
                text-gray-900 dark:text-gray-200 p-2 w-full rounded-md focus:outline-none
                focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
            <input type="text" name="description" id="description" rows="4"
                class="w-full p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400"
                value="{{$category->description}}"></input>
        </div>
        </div>
        <button type="submit"
            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300">
            Update
        </button>
    </form>
</div>
@endsection

@extends('admin.layout')

@section('content')
<div class="p-6 w-full min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Main Content Area -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Products Section (spans 2 columns) -->
        <div class="col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <!-- Header with Import/Export/Add -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Daftar Produk</h2>
                <div class="flex items-center space-x-3">
                    <!-- Import Button -->
                    <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" class="inline-flex">
                        @csrf
                        <input type="file" name="file" class="hidden" id="importFile" accept=".csv,.xlsx,.xls">
                        <button type="button"
                            onclick="document.getElementById('importFile').click()"
                            class="bg-green-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-green-600">
                            Import
                        </button>
                    </form>

                    <!-- Export Button -->
                    <a href="{{ route('admin.products.export') }}"
                        class="bg-blue-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-600">
                        Export
                    </a>

                    <!-- Add Product Button -->
                    <a href="{{ route('admin.menu.product.create') }}"
                        class="bg-indigo-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-indigo-600">
                        + Produk
                    </a>
                </div>
            </div>


            <!-- Search and Filter -->
            <form id="searchForm" method="GET" action="{{ route('admin.products.search') }}">
                <div class="flex gap-4 mb-6">
                    <input type="text" name="query" id="searchInput" placeholder="Cari produk..."
                           class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <select name="category" id="categorySelect" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <script src="{{ mix('js/search.js') }}"></script>
            <!-- Products Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-100">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-100">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-100">{{ $product->sku }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-100">{{ number_format($product->selling_price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('admin.menu.product.edit', $product) }}"
                                            class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400"
                                                onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

           <!-- Pagination -->
<div class="mt-4 border-t border-gray-200 dark:border-gray-700 px-4 py-3">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-700 dark:text-gray-400">
            Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} entri
        </p>
        <!-- Laravel Pagination Links -->
        <div class="flex space-x-2">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
        </div>

        <!-- Categories Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Kategori</h2>
                <a href="{{ route('admin.menu.product.category.create') }}"
                    class="bg-blue-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-600">
                    + Kategori
                </a>
            </div>

            <!-- Categories List -->
            <div class="space-y-4">
                @foreach($categories as $category)
                    <div class="border rounded-lg p-4 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="font-medium text-gray-800 dark:text-gray-100">{{ $category->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->products_count }} produk</p>
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.menu.product.category.edit', $category->id) }}"
                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400">Edit</a>
                                <form action="{{ route('admin.menu.product.category.destroy', $category->id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400"
                                        onclick="return confirm('Yakin hapus kategori ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.getElementById('importFile').addEventListener('change', function() {
    if (this.files.length > 0) {
        this.closest('form').submit();
    }
});
</script>
@endsection

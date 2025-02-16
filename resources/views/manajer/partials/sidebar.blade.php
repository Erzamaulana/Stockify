<aside id="logo-sidebar" class="fixed top-16 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('manajer.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <!-- Produk -->
            <li>
                <a href="{{ route('manajer.products.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="ml-3">Produk</span>
                </a>
            </li>
            <!-- Stock -->
            <li>
                <a href="{{ route('manajer.stock.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="ml-3">Stock</span>
                </a>
            </li>
            <!-- Supplier -->
            <li>
                <a href="{{ route('manajer.suppliers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="ml-3">Supplier</span>
                </a>
            </li>
            <!-- Reports -->
            <li>
                <a href="{{ route('manajer.reports.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <span class="ml-3">Reports</span>
                </a>
            </li>
            <!-- Tambahkan menu lain sesuai kebutuhan untuk Manajer Gudang -->
        </ul>
    </div>
</aside>

@extends('admin.layout') 
@section('content')
<div class="p-6 w-full min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Filter Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Filter Laporan</h2>
            <form action="" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Periode</label>
                    <div class="flex gap-2">
                        <input type="date" name="start_date" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <input type="date" name="end_date" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Kategori</label>
                    <select name="category" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="1">Kategori 1</option>
                        <option value="2">Kategori 2</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabs Section -->
        <div class="mb-6">
            <nav class="flex space-x-4" aria-label="Tabs">
                <button class="px-4 py-2 text-sm font-medium rounded-md bg-blue-600 text-white dark:bg-blue-500" 
                        onclick="showTab('stock-report')" id="stock-tab">
                    Laporan Stok Barang
                </button>
                <button class="px-4 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white" 
                        onclick="showTab('transaction-report')" id="transaction-tab">
                    Laporan Transaksi
                </button>
                <button class="px-4 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white" 
                        onclick="showTab('user-activity')" id="activity-tab">
                    Aktivitas Pengguna
                </button>
            </nav>
        </div>

        <!-- Stock Report Section -->
        <div id="stock-report" class="report-section">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Laporan Stok Barang</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Stok</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Satuan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">BRG001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">Barang 1</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">Kategori 1</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">100</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">Pcs</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Report Section -->
        <div id="transaction-report" class="report-section hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Laporan Transaksi</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">No Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jenis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Barang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">2024-01-01</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">TRX001</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Masuk
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">Barang 1</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">50</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">Pembelian</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Activity Section -->
        <div id="user-activity" class="report-section hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Aktivitas Pengguna</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Pengguna</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aktivitas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">2024-01-01 08:00:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">Admin</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">Login</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">Login berhasil</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Export Buttons -->
        <div class="mt-4 flex gap-2">
            <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600">
                Export PDF
            </button>
            <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 dark:bg-green-500 dark:hover:bg-green-600">
                Export Excel
            </button>
        </div>
    </div>
</div>

<script>
function showTab(tabId) {
    // Hide all report sections
    document.querySelectorAll('.report-section').forEach(section => {
        section.classList.add('hidden');
    });
    
    // Show selected section
    document.getElementById(tabId).classList.remove('hidden');
    
    // Update tab styles
    document.querySelectorAll('nav button').forEach(button => {
        button.classList.remove('bg-blue-600', 'dark:bg-blue-500', 'text-white');
        button.classList.add('text-gray-500', 'dark:text-gray-300', 'hover:text-gray-700', 'dark:hover:text-white');
    });
    
    // Highlight active tab
    const activeTab = document.querySelector(`button[onclick="showTab('${tabId}')"]`);
    activeTab.classList.add('bg-blue-600', 'dark:bg-blue-500', 'text-white');
    activeTab.classList.remove('text-gray-500', 'dark:text-gray-300', 'hover:text-gray-700', 'dark:hover:text-white');
}

// Initialize first tab as active
document.addEventListener('DOMContentLoaded', () => {
    showTab('stock-report');
});
</script>
@endsection
@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="container mx-auto p-6 mt-14 dark:bg-gray-900">
    <!-- Judul Halaman (Tanpa Dark Mode) -->
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Laporan</h1>

    <!-- Tabs Navigasi -->
    <div class="mb-6 border-b dark:border-gray-700">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="#stock" class="tab-link text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium">Stok Barang</a>
            <a href="#transaction" class="tab-link text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium">Transaksi</a>
            <a href="#activity" class="tab-link text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium">Aktivitas Pengguna</a>
        </nav>
    </div>

    <!-- Konten Tab: Laporan Stok Barang -->
    <div id="stock" class="tab-content">
        <h2 class="text-2xl font-semibold mb-4 dark:text-white">Laporan Stok Barang</h2>
        <!-- Form Filter -->
        <form action="{{ route('admin.reports.index') }}" method="GET" class="mb-4 flex flex-wrap gap-4 items-end">
            <div>
                <label for="start_date" class="block text-gray-700 dark:text-gray-300">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate ?? '' }}" 
                       class="border p-2 rounded dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label for="end_date" class="block text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate ?? '' }}" 
                       class="border p-2 rounded dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label for="category_id" class="block text-gray-700 dark:text-gray-300">Kategori</label>
                <select name="category_id" id="category_id" 
                        class="border p-2 rounded dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (isset($categoryId) && $categoryId == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition dark:bg-blue-600 dark:hover:bg-blue-700">
                Filter
            </button>
        </form>
        
        <!-- Tabel Stok -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-4 py-2 border dark:border-gray-600 text-center">No</th>
                        <th class="px-4 py-2 border dark:border-gray-600">Produk</th>
                        <th class="px-4 py-2 border dark:border-gray-600">Kategori</th>
                        <th class="px-4 py-2 border dark:border-gray-600 text-center">Stok</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900 dark:text-gray-100">
                    @forelse($stockReport as $index => $data)
                        <tr class="border-t hover:bg-gray-100 dark:hover:bg-gray-700 dark:border-gray-600">
                            <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $data->product_name }}</td>
                            <td class="px-4 py-2">{{ $data->category_name }}</td>
                            <td class="px-4 py-2 text-center">{{ $data->stock }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-4 text-gray-500 dark:text-gray-400">Tidak ada data laporan stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Konten Tab: Laporan Transaksi -->
    <div id="transaction" class="tab-content hidden">
        <h2 class="text-2xl font-semibold mb-4 dark:text-white">Laporan Transaksi Barang</h2>
        <!-- Form Filter -->
        <form action="{{ route('admin.reports.index') }}" method="GET" class="mb-4 flex flex-wrap gap-4 items-end">
            <div>
                <label for="start_date_tx" class="block text-gray-700 dark:text-gray-300">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date_tx" value="{{ $startDate ?? '' }}" 
                       class="border p-2 rounded dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label for="end_date_tx" class="block text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date_tx" value="{{ $endDate ?? '' }}" 
                       class="border p-2 rounded dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition dark:bg-blue-600 dark:hover:bg-blue-700">
                Filter
            </button>
        </form>
        
        <!-- Tabel Transaksi -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-4 py-2 border dark:border-gray-600 text-center">No</th>
                        <th class="px-4 py-2 border dark:border-gray-600">Tanggal</th>
                        <th class="px-4 py-2 border dark:border-gray-600">Tipe</th>
                        <th class="px-4 py-2 border dark:border-gray-600">Produk</th>
                        <th class="px-4 py-2 border dark:border-gray-600 text-center">Jumlah</th>
                        <th class="px-4 py-2 border dark:border-gray-600">User</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900 dark:text-gray-100">
                    @forelse($transactionReport as $index => $transaction)
                        <tr class="border-t hover:bg-gray-100 dark:hover:bg-gray-700 dark:border-gray-600">
                            <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $transaction->date }}</td>
                            <td class="px-4 py-2">{{ $transaction->type }}</td>
                            <td class="px-4 py-2">{{ $transaction->product_name }}</td>
                            <td class="px-4 py-2 text-center">{{ $transaction->quantity }}</td>
                            <td class="px-4 py-2">{{ isset($transaction->user_name) ? $transaction->user_name : 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500 dark:text-gray-400">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Konten Tab: Laporan Aktivitas -->
    <div id="activity" class="tab-content hidden">
        <h2 class="text-2xl font-semibold mb-4 dark:text-white">Laporan Aktivitas Pengguna</h2>
        <!-- Form Filter -->
        <form action="{{ route('admin.reports.index') }}" method="GET" class="mb-4 flex flex-wrap gap-4 items-end">
            <div>
                <label for="user_id" class="block text-gray-700 dark:text-gray-300">Pengguna</label>
                <select name="user_id" id="user_id" 
                        class="border p-2 rounded dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua Pengguna</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ (isset($userId) && $userId == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="start_date_act" class="block text-gray-700 dark:text-gray-300">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date_act" value="{{ $startDate ?? '' }}" 
                       class="border p-2 rounded dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <div>
                <label for="end_date_act" class="block text-gray-700 dark:text-gray-300">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date_act" value="{{ $endDate ?? '' }}" 
                       class="border p-2 rounded dark:border-gray-600 dark:bg-gray-700 dark:text-white">
            </div>
            <button type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition dark:bg-blue-600 dark:hover:bg-blue-700">
                Filter
            </button>
        </form>
        
        <!-- Tabel Aktivitas -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="px-4 py-2 border dark:border-gray-600 text-center">No</th>
                        <th class="px-4 py-2 border dark:border-gray-600">Tanggal</th>
                        <th class="px-4 py-2 border dark:border-gray-600">Pengguna</th>
                        <th class="px-4 py-2 border dark:border-gray-600">Aktivitas</th>
                    </tr>
                </thead>
                <tbody class="text-gray-900 dark:text-gray-100">
                    @forelse($userActivity as $index => $activity)
                        <tr class="border-t hover:bg-gray-100 dark:hover:bg-gray-700 dark:border-gray-600">
                            <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">
                                {{ isset($activity->date) ? $activity->date : (isset($activity->created_at) ? $activity->created_at : 'N/A') }}
                            </td>
                            <td class="px-4 py-2">{{ isset($activity->user_name) ? $activity->user_name : 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $activity->activity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-4 text-gray-500 dark:text-gray-400">Tidak ada data aktivitas pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Update JavaScript untuk dark mode
    document.addEventListener('DOMContentLoaded', function() {
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');
        
        function hideAllTabs() {
            tabContents.forEach(content => content.classList.add('hidden'));
        }
        
        function activateTab(tabId) {
            hideAllTabs();
            const activeTab = document.getElementById(tabId);
            if(activeTab) activeTab.classList.remove('hidden');
        }
        
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('href').substring(1);
                activateTab(target);
                
                // Update styling untuk dark mode
                tabLinks.forEach(item => {
                    item.classList.remove(
                        'border-blue-500', 
                        'font-bold',
                        'dark:border-blue-400',
                        'dark:text-blue-400'
                    );
                });
                
                this.classList.add(
                    'border-blue-500',
                    'font-bold',
                    'dark:border-blue-400',
                    'dark:text-blue-400'
                );
            });
        });
        
        // Aktifkan tab pertama
        if(tabLinks.length > 0) tabLinks[0].click();
    });
</script>
@endsection
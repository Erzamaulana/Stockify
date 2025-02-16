@extends('layouts.app')

@section('title', 'Laporan - Manajer Gudang')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <h1 class="text-3xl font-bold mb-6">Laporan Manajer Gudang</h1>

    <!-- Tabs Navigasi -->
    <div class="mb-6 border-b">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="#stock" class="tab-link text-gray-500 hover:text-gray-700 whitespace-nowrap pb-4 px-1 border-b-2 font-medium" id="tab-stock">Stok Barang</a>
            <a href="#transaction" class="tab-link text-gray-500 hover:text-gray-700 whitespace-nowrap pb-4 px-1 border-b-2 font-medium" id="tab-transaction">Transaksi</a>
            <a href="#activity" class="tab-link text-gray-500 hover:text-gray-700 whitespace-nowrap pb-4 px-1 border-b-2 font-medium" id="tab-activity">Aktivitas Pengguna</a>
        </nav>
    </div>

    <!-- Konten Tab: Laporan Stok Barang -->
    <div id="stock" class="tab-content">
        <h2 class="text-2xl font-semibold mb-4">Laporan Stok Barang</h2>
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border text-center">No</th>
                    <th class="px-4 py-2 border">Produk</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border text-center">Stok</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockReport as $index => $data)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $data->product_name }}</td>
                        <td class="px-4 py-2">{{ $data->category_name }}</td>
                        <td class="px-4 py-2 text-center">{{ $data->stock }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4 text-gray-500">Tidak ada data laporan stok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Konten Tab: Laporan Transaksi Barang -->
    <div id="transaction" class="tab-content hidden">
        <h2 class="text-2xl font-semibold mb-4">Laporan Transaksi Barang</h2>
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border text-center">No</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Tipe</th>
                    <th class="px-4 py-2 border">Produk</th>
                    <th class="px-4 py-2 border text-center">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactionReport as $index => $transaction)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $transaction->date }}</td>
                        <td class="px-4 py-2">{{ $transaction->type }}</td>
                        <td class="px-4 py-2">{{ $transaction->product_name }}</td>
                        <td class="px-4 py-2 text-center">{{ $transaction->quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Konten Tab: Laporan Aktivitas Pengguna -->
    <div id="activity" class="tab-content hidden">
        <h2 class="text-2xl font-semibold mb-4">Laporan Aktivitas Pengguna</h2>
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border text-center">No</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Pengguna</th>
                    <th class="px-4 py-2 border">Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userActivity as $index => $activity)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $activity->date }}</td>
                        <td class="px-4 py-2">{{ $activity->user_name }}</td>
                        <td class="px-4 py-2">{{ $activity->activity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4 text-gray-500">Tidak ada data aktivitas pengguna.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript untuk Tab -->
<script>
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');

    function hideAllTabs() {
        tabContents.forEach(content => content.classList.add('hidden'));
    }

    function activateTab(tabId) {
        hideAllTabs();
        document.getElementById(tabId).classList.remove('hidden');
    }

    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('href').substring(1);
            activateTab(target);
            tabLinks.forEach(item => item.classList.remove('border-blue-500', 'font-bold'));
            this.classList.add('border-blue-500', 'font-bold');
        });
    });

    if(tabLinks.length > 0){
        tabLinks[0].click();
    }
</script>
@endsection

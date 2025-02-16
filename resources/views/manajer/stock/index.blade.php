@extends('layouts.app')

@section('title', 'Stock Management')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <h1 class="text-3xl font-bold mb-6">Stock Management (Manajer Gudang)</h1>

    <!-- Tab Navigasi -->
    <ul class="flex border-b mb-6">
        <li class="-mb-px mr-1">
            <a href="#barangMasuk" class="tab-link bg-gray-200 px-4 py-2 rounded-t" onclick="activateTab('barangMasuk')">Barang Masuk</a>
        </li>
        <li class="mr-1">
            <a href="#barangKeluar" class="tab-link bg-gray-200 px-4 py-2 rounded-t" onclick="activateTab('barangKeluar')">Barang Keluar</a>
        </li>
        <li class="mr-1">
            <a href="#stockOpname" class="tab-link bg-gray-200 px-4 py-2 rounded-t" onclick="activateTab('stockOpname')">Stock Opname</a>
        </li>
    </ul>

    <!-- Konten Tab: Barang Masuk -->
    <div id="barangMasuk" class="tab-content">
        <h2 class="text-2xl font-semibold mb-4">Transaksi Barang Masuk</h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-fixed border-collapse">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="w-1/12 px-4 py-2 border">ID</th>
                        <th class="w-3/12 px-4 py-2 border">Produk</th>
                        <th class="w-2/12 px-4 py-2 border">Jumlah</th>
                        <th class="w-3/12 px-4 py-2 border">Tanggal</th>
                        <th class="w-3/12 px-4 py-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incomingTransactions as $transaction)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2 text-center">{{ $transaction->id }}</td>
                            <td class="px-4 py-2">{{ $transaction->product->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">{{ $transaction->quantity }}</td>
                            <td class="px-4 py-2">{{ $transaction->date }}</td>
                            <td class="px-4 py-2 text-center">{{ $transaction->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada data transaksi barang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Konten Tab: Barang Keluar -->
    <div id="barangKeluar" class="tab-content hidden">
        <h2 class="text-2xl font-semibold mb-4">Transaksi Barang Keluar</h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-fixed border-collapse">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="w-1/12 px-4 py-2 border">ID</th>
                        <th class="w-3/12 px-4 py-2 border">Produk</th>
                        <th class="w-2/12 px-4 py-2 border">Jumlah</th>
                        <th class="w-3/12 px-4 py-2 border">Tanggal</th>
                        <th class="w-3/12 px-4 py-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($outgoingTransactions as $transaction)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2 text-center">{{ $transaction->id }}</td>
                            <td class="px-4 py-2">{{ $transaction->product->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">{{ $transaction->quantity }}</td>
                            <td class="px-4 py-2">{{ $transaction->date }}</td>
                            <td class="px-4 py-2 text-center">{{ $transaction->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada data transaksi barang keluar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Konten Tab: Stock Opname -->
    <div id="stockOpname" class="tab-content hidden">
        <h2 class="text-2xl font-semibold mb-4">Stock Opname</h2>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-fixed border-collapse">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="w-3/12 px-4 py-2 border">Produk</th>
                        <th class="w-3/12 px-4 py-2 border">Stok Sistem</th>
                        <th class="w-3/12 px-4 py-2 border">Stok Fisik</th>
                        <th class="w-3/12 px-4 py-2 border">Selisih</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockOpnameData as $data)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $data['product'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $data['system_stock'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $data['physical_stock'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $data['difference'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-4 text-gray-500">Tidak ada data stock opname.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function activateTab(tabId) {
        // Sembunyikan semua tab
        const tabs = document.querySelectorAll('.tab-content');
        tabs.forEach(tab => tab.classList.add('hidden'));
        // Tampilkan tab yang dipilih
        document.getElementById(tabId).classList.remove('hidden');

        // Update kelas untuk tab link
        const tabLinks = document.querySelectorAll('.tab-link');
        tabLinks.forEach(link => link.classList.remove('border-blue-500', 'font-bold'));
        event.target.classList.add('border-blue-500', 'font-bold');
    }

    // Aktifkan tab pertama secara default
    document.addEventListener("DOMContentLoaded", function() {
        const firstTab = document.querySelector('.tab-link');
        if(firstTab) firstTab.click();
    });
</script>
@endsection

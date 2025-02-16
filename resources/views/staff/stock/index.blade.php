@extends('layouts.app')

@section('title', 'Riwayat Transaksi Stok (Staff)')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <h1 class="text-3xl font-bold mb-6">Konfirmasi Transaksi Stok</h1>
    <table class="min-w-full mt-4 bg-white dark:bg-gray-800 border-collapse">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="px-4 py-2 border text-center">ID</th>
                <th class="px-4 py-2 border">Produk</th>
                <th class="px-4 py-2 border">Tipe</th>
                <th class="px-4 py-2 border text-center">Jumlah</th>
                <th class="px-4 py-2 border">Tanggal</th>
                <th class="px-4 py-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr class="border-t hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-4 py-2 text-center">{{ $transaction->id }}</td>
                    <td class="px-4 py-2">{{ $transaction->product->name }}</td>
                    <td class="px-4 py-2">{{ $transaction->type }}</td>
                    <td class="px-4 py-2 text-center">{{ $transaction->quantity }}</td>
                    <td class="px-4 py-2">{{ $transaction->created_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center space-x-2">
                            <!-- Tombol untuk Konfirmasi (Diterima) -->
                            <form action="{{ route('staff.stock.update_status', $transaction->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Diterima">
                                @if($transaction->type == 'Masuk')
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                        Konfirmasi Penerimaan
                                    </button>
                                @else
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                        Konfirmasi Pengeluaran
                                    </button>
                                @endif
                            </form>
                            <!-- Tombol untuk Tolak -->
                            <form action="{{ route('staff.stock.update_status', $transaction->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">
                        Tidak ada transaksi stok pending.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

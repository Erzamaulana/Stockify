@extends('layouts.app')

@section('title', 'Konfirmasi Transaksi Stok (Pending)')

@section('content')
<div class="container mx-auto p-6 mt-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">Konfirmasi Transaksi Stok (Pending)</h1>

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b dark:border-gray-600">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b dark:border-gray-600">Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b dark:border-gray-600">Tipe</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b dark:border-gray-600">Jumlah</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b dark:border-gray-600">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b dark:border-gray-600">Catatan</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider border-b dark:border-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $transaction->id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $transaction->product->name }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($transaction->type === 'Masuk') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                @else bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100 @endif">
                                {{ $transaction->type }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">{{ $transaction->quantity }}</td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">
                            {{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100 max-w-xs">{{ $transaction->notes }}</td>
                        <td class="px-4 py-3 space-y-2">
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('staff.stock.update_status', $transaction->id) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    <input type="hidden" name="status" value="Diterima">
                                    <input 
                                        type="datetime-local" 
                                        name="received_at" 
                                        class="text-sm rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 p-1"
                                        required
                                    >
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:focus:ring-offset-gray-800">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terima
                                    </button>
                                </form>
                                
                                <form action="{{ route('staff.stock.update_status', $transaction->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Ditolak">
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            Tidak ada transaksi pending.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
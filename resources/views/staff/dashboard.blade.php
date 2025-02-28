@extends('layouts.app')

@section('title', 'Dashboard Staff Gudang')

@section('content')
<div class="container mx-auto p-6 mt-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">Dashboard Staff Gudang</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Transaksi Masuk Pending -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border dark:border-gray-700">
                <div class="p-4 border-b dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 inline-block mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Barang Masuk Perlu Verifikasi
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @php
                                $incomingPending = $dashboardData['pending']->filter(function($transaction) {
                                    return $transaction->type === 'Masuk';
                                });
                            @endphp
                            @forelse($incomingPending as $transaction)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">
                                        {{ $transaction->product->name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $transaction->quantity }} unit
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('staff.stock.pending') }}" class="text-blue-600 dark:text-blue-400 text-sm hover:underline">
                                            Verifikasi
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada transaksi masuk pending
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Transaksi Keluar Pending -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow border dark:border-gray-700">
                <div class="p-4 border-b dark:border-gray-700">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 inline-block mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Barang Keluar Perlu Penyiapan
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @php
                                $outgoingPending = $dashboardData['pending']->filter(function($transaction) {
                                    return $transaction->type === 'Keluar';
                                });
                            @endphp
                            @forelse($outgoingPending as $transaction)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-100">
                                        {{ $transaction->product->name }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $transaction->quantity }} unit
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('staff.stock.pending') }}" class="text-blue-600 dark:text-blue-400 text-sm hover:underline">
                                            Proses
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Tidak ada transaksi keluar pending
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
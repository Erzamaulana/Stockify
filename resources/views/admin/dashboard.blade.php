@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 mt-6">Dashboard Admin</h1>

    <!-- Kartu Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card: Total Produk -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $dashboardData['total_products'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Transaksi Masuk -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <div class="flex items-center space-x-4">
                <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Transaksi Masuk</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $dashboardData['incoming_transactions'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Transaksi Keluar -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <div class="flex items-center space-x-4">
                <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Transaksi Keluar</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $dashboardData['outgoing_transactions'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Stok Menipis -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <div class="flex items-center space-x-4">
                <div class="bg-red-100 dark:bg-red-900 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Stok Menipis</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ count($dashboardData['low_stock_products'] ?? []) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid untuk Aktivitas dan Grafik -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Aktivitas Pengguna -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="border-b border-gray-200 dark:border-gray-700 p-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Aktivitas Pengguna Terbaru</h2>
            </div>
            <div class="p-4">
                @if($recentActivities->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada aktivitas terbaru.</p>
                @else
                    <div class="space-y-4">
                        @foreach($recentActivities as $activity)
                            <div class="border-b border-gray-100 dark:border-gray-700 pb-4 last:border-0 last:pb-0">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900 dark:text-white">
                                            <span class="font-medium">{{ $activity->user->name }}</span>
                                            <span class="text-gray-600 dark:text-gray-400">melakukan:</span>
                                            <span class="italic">{{ $activity->activity }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ $activity->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $recentActivities->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Grafik Stok -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="border-b border-gray-200 dark:border-gray-700 p-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Grafik Stok Barang</h2>
            </div>
            <div class="p-4">
                <canvas id="stockChart" class="w-full h-[300px]"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dashboardData['labels']),
                datasets: [{
                    label: 'Stok Barang',
                    data: @json($dashboardData['data']),
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(156, 163, 175, 0.1)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 6
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
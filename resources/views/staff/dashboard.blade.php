@extends('layouts.app')

@section('title', 'Dashboard Staff Gudang')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <h1 class="text-3xl font-bold mb-6">Dashboard Staff Gudang</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Bagian Transaksi Masuk yang Pending -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Barang Masuk yang Perlu Diperiksa</h2>
            @php
                // Filter transaksi pending yang tipe-nya 'Masuk'
                $incomingPending = $dashboardData['pending']->filter(function($transaction) {
                    return $transaction->type === 'Masuk';
                });
            @endphp
            @if($incomingPending->isNotEmpty())
                <ul class="list-disc pl-5">
                    @foreach($incomingPending as $transaction)
                        <li>
                            {{ $transaction->product->name }} - {{ $transaction->quantity }} unit
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada transaksi barang masuk pending.</p>
            @endif
        </div>
        
        <!-- Bagian Transaksi Keluar yang Pending -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Barang Keluar yang Perlu Disiapkan</h2>
            @php
                // Filter transaksi pending yang tipe-nya 'Keluar'
                $outgoingPending = $dashboardData['pending']->filter(function($transaction) {
                    return $transaction->type === 'Keluar';
                });
            @endphp
            @if($outgoingPending->isNotEmpty())
                <ul class="list-disc pl-5">
                    @foreach($outgoingPending as $transaction)
                        <li>
                            {{ $transaction->product->name }} - {{ $transaction->quantity }} unit
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada transaksi barang keluar pending.</p>
            @endif
        </div>
    </div>
</div>
@endsection

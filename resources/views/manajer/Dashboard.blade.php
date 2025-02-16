@extends('layouts.app')

@section('title', 'Dashboard Manajer Gudang')

@section('content')
<div class="container mx-auto p-6 mt-14">
    <h1 class="text-3xl font-bold mb-6">Dashboard Manajer Gudang</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stok Menipis -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Stok Menipis</h2>
            @if($data['low_stock']->isNotEmpty())
                <ul class="list-disc pl-5">
                    @foreach($data['low_stock'] as $product)
                        <li>{{ $product->name }} ({{ $product->stock }})</li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada produk stok menipis.</p>
            @endif
        </div>
        <!-- Barang Masuk Hari Ini -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Barang Masuk Hari Ini</h2>
            <p class="text-2xl font-bold">{{ $data['incoming'] ?? 0 }} unit</p>
        </div>
        <!-- Barang Keluar Hari Ini -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Barang Keluar Hari Ini</h2>
            <p class="text-2xl font-bold">{{ $data['outgoing'] ?? 0 }} unit</p>
        </div>
    </div>
</div>
@endsection

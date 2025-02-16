@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container mx-auto px-4 py-6 mt-6">
    <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col md:flex-row">
        @if($product->image)
        <div class="md:w-1/3">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-lg object-cover w-full h-64">
        </div>
        @endif
        <div class="md:w-2/3 md:ml-6 mt-4 md:mt-0">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="mb-2"><strong>SKU:</strong> {{ $product->sku }}</p>
            <p class="mb-2"><strong>Harga Jual:</strong> Rp {{ number_format($product->selling_price, 0, ',', '.') }}</p>
            <p class="mb-2"><strong>Stok:</strong> {{ $product->stock }}</p>
            <p class="mb-2"><strong>Kategori:</strong> {{ $product->category->name }}</p>
            <p class="mb-2"><strong>Deskripsi:</strong></p>
            <p class="mb-4">{{ $product->description }}</p>
            <a href="{{ route('manajer.products.index') }}" class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection

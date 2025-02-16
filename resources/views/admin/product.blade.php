@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

    <!-- Tabs untuk Navigasi -->
    <div class="flex space-x-4 border-b pb-2 mb-4">
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 {{ request()->routeIs('admin.products.index') ? 'border-b-2 border-blue-500 font-bold' : '' }}">
            Produk
        </a>
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 {{ request()->routeIs('admin.categories.index') ? 'border-b-2 border-blue-500 font-bold' : '' }}">
            Kategori
        </a>
        <a href="{{ route('admin.attributes.index') }}" class="px-4 py-2 {{ request()->routeIs('admin.attributes.index') ? 'border-b-2 border-blue-500 font-bold' : '' }}">
            Atribut Produk
        </a>
        <a href="{{ route('admin.products.import') }}" class="px-4 py-2 {{ request()->routeIs('admin.products.import') ? 'border-b-2 border-blue-500 font-bold' : '' }}">
            Import / Export
        </a>
    </div>

    <!-- Konten berdasarkan tab -->
    @if(request()->routeIs('admin.products.index'))
        @include('admin.menu.product.partials.list')
    @elseif(request()->routeIs('admin.categories.index'))
        @include('admin.menu.product.partials.categories')
    @elseif(request()->routeIs('admin.attributes.index'))
        @include('admin.menu.product.partials.attributes')
    @elseif(request()->routeIs('admin.products.import'))
        @include('admin.menu.product.partials.import')
    @endif

@endsection

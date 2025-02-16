@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="mt-14">
    <h1 class="text-3xl font-bold mb-6">Daftar Supplier</h1>
    <table class="min-w-full mt-4 bg-white dark:bg-gray-800">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Nama</th>
                <th class="px-4 py-2 border">Alamat</th>
                <th class="px-4 py-2 border">Telepon</th>
                <th class="px-4 py-2 border">Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $supplier->name }}</td>
                <td class="px-4 py-2">{{ $supplier->address }}</td>
                <td class="px-4 py-2">{{ $supplier->phone }}</td>
                <td class="px-4 py-2">{{ $supplier->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

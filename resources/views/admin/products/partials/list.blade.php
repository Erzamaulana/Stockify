<!-- <div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="w-full table-fixed border-collapse">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="w-1/12 px-4 py-2 border text-left">SKU</th>
                <th class="w-2/12 px-4 py-2 border text-left">Nama</th>
                <th class="w-2/12 px-4 py-2 border text-right">Harga Jual</th>
                <th class="w-2/12 px-4 py-2 border text-left">Kategori</th>
                <th class="w-3/12 px-4 py-2 border text-left">Atribut</th>
                <th class="w-2/12 px-4 py-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-t hover:bg-gray-100">
                <td class="px-4 py-2">{{ $product->sku }}</td>
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2 text-right">{{ number_format($product->selling_price, 2) }}</td>
                <td class="px-4 py-2">{{ $product->category->name }}</td>
                <td class="px-4 py-2">
                    @if($product->attributes && count($product->attributes) > 0)
                        @foreach($product->attributes as $attribute)
                            <div>{{ $attribute->name }}: {{ $attribute->value }}</div>
                        @endforeach
                    @else
                        <span class="text-gray-500">Tidak ada atribut tersedia.</span>
                    @endif
                </td>
                <td class="px-4 py-2 text-center space-x-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus produk?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    // Handling Success Message
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    @endif

    // Handling Error Message
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    @endif

    // Handling Info Message
    @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: "{{ session('info') }}",
            showConfirmButton: true
        });
    @endif
</script>
@endpush -->
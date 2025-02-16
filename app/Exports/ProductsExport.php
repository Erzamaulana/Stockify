<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::with(['category', 'supplier'])->get();
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->category->name ?? '', // Assuming category has name field
            $product->supplier->name ?? '', // Assuming supplier has name field
            $product->sku,
            $product->purchase_price,
            $product->selling_price,
            $product->description
        ];
    }

    public function headings(): array
    {
        return [
            "ID",
            "Nama Produk",
            "Kategori",
            "Supplier",
            "SKU",
            "Harga Beli",
            "Harga Jual",
            "Deskripsi"
        ];
    }
}

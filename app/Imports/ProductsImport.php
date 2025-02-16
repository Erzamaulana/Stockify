<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Get category and supplier IDs
        $category = Category::where('name', $row['kategori'])->first();
        $supplier = Supplier::where('name', $row['supplier'])->first();

        return new Product([
            'name' => $row['nama_produk'],
            'category_id' => $category ? $category->id : null,
            'supplier_id' => $supplier ? $supplier->id : null,
            'sku' => $row['sku'],
            'purchase_price' => $row['harga_beli'],
            'selling_price' => $row['harga_jual'],
            'description' => $row['deskripsi'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama_produk' => 'required',
            '*.kategori' => 'required|exists:categories,name',
            '*.supplier' => 'required|exists:suppliers,name',
            '*.sku' => 'required|unique:products,sku',
            '*.harga_beli' => 'required|numeric',
            '*.harga_jual' => 'required|numeric',
        ];
    }
}

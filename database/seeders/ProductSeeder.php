<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            // Tentukan apakah produk adalah minuman (odd) atau makanan (even)
            $isMinuman = ($i % 2 == 1); // misalnya, produk dengan indeks ganjil adalah minuman
            $skuPrefix = $isMinuman ? 'MNM' : 'MKN';
            $sku = $skuPrefix . sprintf("%03d", $i);

            // Category ID dari 1 sampai 5 secara berulang
            $category_id = ($i % 2 == 0) ? 2 : 1;
            // Misalnya, gunakan juga supplier_id dari 1 sampai 5 secara berulang
            $supplier_id = ($i % 5 == 0) ? 5 : $i % 5;

            // Buat nama dan deskripsi dummy
            $name = $isMinuman ? "Minuman Produk $i" : "Makanan Produk $i";
            $description = $isMinuman 
                ? "Deskripsi minuman produk $i (contoh deskripsi dari kamu saja)"
                : "Deskripsi makanan produk $i (contoh deskripsi dari anda saja)";

            // Contoh harga, kamu bisa sesuaikan rumus atau nilainya
            $purchase_price = $isMinuman ? 3000 + ($i * 10) : 5000 + ($i * 15);
            $selling_price = $isMinuman ? 5500 + ($i * 12) : 8000 + ($i * 20);

            // Tentukan path gambar (asumsi sudah ada gambar sample di folder 'public/products')
            $image = "products/product-$i.jpg";

            Product::create([
                'category_id'    => $category_id,
                'supplier_id'    => $supplier_id,
                'name'           => $name,
                'sku'            => $sku,
                'description'    => $description,
                'purchase_price' => $purchase_price,
                'selling_price'  => $selling_price,
                'image'          => $image,
                // Jika kamu sudah menambahkan field 'stock' di tabel products,
                // kamu bisa set nilai stok awal, misalnya:
                'stock'          => 100,
            ]);
        }
    }
}

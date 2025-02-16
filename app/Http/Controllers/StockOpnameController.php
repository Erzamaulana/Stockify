<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Events\ActivityOccurred; // pastikan event sudah dibuat

class StockOpnameController extends Controller
{
    public function index()
    {
        // Ambil semua produk
        $products = Product::all();

        // Buat data stock opname dengan menghitung perbedaan (contoh dummy calculation)
        $stockOpnameData = $products->map(function($product) {
            // Misal, stok fisik dihasilkan secara acak untuk demo (real-nya, data ini berasal dari proses opname)
            $physicalStock = $product->stock - rand(0, 10);
            $difference = $product->stock - $physicalStock;
            return [
                'product'        => $product->name,
                'system_stock'   => $product->stock,
                'physical_stock' => $physicalStock,
                'difference'     => $difference,
            ];
        });

        // Dispatch event untuk mencatat aktivitas stock opname
        event(new ActivityOccurred(
            auth()->id(),
            "Melihat Stock Opname",
            "User melihat data stock opname untuk " . $products->count() . " produk."
        ));

        return view('admin.stock.opname', compact('stockOpnameData'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductAttributeService;
use App\Models\ProductAttribute;
use App\Models\Product;
use App\Events\ActivityOccurred; // Import event ActivityOccurred

class ProductAttributeController extends Controller
{
    protected ProductAttributeService $attributeService;

    public function __construct(ProductAttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    // Tampilkan daftar atribut produk
    public function index()
    {
        $attributes = $this->attributeService->all(); 
        return view('admin.product_attributes.index', compact('attributes'));
    }
    
    // Tampilkan form tambah atribut
    public function create()
    {
        $products = Product::all(); // Ambil semua produk
        return view('admin.product_attributes.create', compact('products'));
    }
    
    // Simpan atribut baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id', // Pastikan produk yang dipilih valid
            'name'       => 'required|string|max:255',
            'value'      => 'required|string|max:255',
        ]);

        // Simpan data menggunakan service
        $attribute = $this->attributeService->createAttribute($validated);

        // Dispatch event untuk mencatat aktivitas penambahan atribut
        event(new ActivityOccurred(
            auth()->id(),
            "Membuat Atribut Produk",
            "Atribut '{$attribute->name}' untuk produk ID {$attribute->product_id} berhasil ditambahkan."
        ));

        return redirect()->route('admin.product_attributes.index', ['product' => $request->product_id])
                     ->with('success', 'Atribut berhasil ditambahkan.');
    }
    
    // Tampilkan form edit atribut
    public function edit($id)
    {
        $attribute = $this->attributeService->getAttribute($id); // Pastikan method getAttribute ada di service/repository
        $products = Product::all(); // Ambil semua produk untuk dropdown
        return view('admin.product_attributes.edit', compact('attribute', 'products'));
    }
    
    // Update atribut
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name'       => 'required|string|max:255',
            'value'      => 'required|string|max:255',
        ]);

        $attribute = ProductAttribute::findOrFail($id);
        $attribute->update([
            'product_id' => $request->product_id,
            'name'       => $request->name,
            'value'      => $request->value,
        ]);

        // Dispatch event untuk mencatat aktivitas update atribut
        event(new ActivityOccurred(
            auth()->id(),
            "Memperbarui Atribut Produk",
            "Atribut '{$attribute->name}' untuk produk ID {$attribute->product_id} berhasil diperbarui."
        ));

        return redirect()->route('admin.product_attributes.index')->with('success', 'Atribut berhasil diperbarui.');
    }
    
    // Hapus atribut
    public function destroy($id)
    {
        $this->attributeService->deleteAttribute($id);

        // Dispatch event untuk mencatat aktivitas penghapusan atribut
        event(new ActivityOccurred(
            auth()->id(),
            "Menghapus Atribut Produk",
            "Atribut dengan ID {$id} berhasil dihapus."
        ));

        return redirect()->back()->with('success', 'Atribut berhasil dihapus.');
    }
}

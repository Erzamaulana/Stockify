<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Category;
use App\Models\Supplier;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\ActivityOccurred; // Tambahkan use event

class ProductController extends Controller
{
    protected ProductService $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Menampilkan daftar produk.
     * Untuk Admin: menampilkan CRUD; untuk Manajer Gudang: read-only.
     */
    public function index()
    {
        // Menggunakan pagination (misalnya 10 produk per halaman)
        $products = $this->productService->getPaginatedProducts(10);
        
        if (auth()->user()->role === 'Manajer Gudang') {
            return view('manajer.products.index', compact('products'));
        }
        return view('admin.products.index', compact('products'));
    }

    /**
     * Menampilkan detail produk.
     */
    public function show($id)
    {
        $product = $this->productService->getProduct($id);
        if (auth()->user()->role === 'Manajer Gudang') {
            return view('manajer.products.show', compact('product'));
        }
        return view('admin.products.show', compact('product'));
    }

    // --- Transaksi Stok: Barang Masuk / Barang Keluar ---

    /**
     * Menampilkan form transaksi stok (barang masuk/keluar) untuk Admin.
     * Parameter $type harus bernilai 'Masuk' atau 'Keluar'.
     */
    public function createTransaction($type)
    {
        if (auth()->user()->role !== 'Admin') {
            abort(403, 'Access Denied');
        }
        $type = trim($type);
        if (!in_array($type, ['Masuk', 'Keluar'])) {
            abort(400, 'Invalid transaction type');
        }
        // Ambil daftar produk untuk dipilih di form transaksi
        $products = $this->productService->getAllProducts();
        return view('admin.products.transaction', compact('products', 'type'));
    }

    /**
     * Memproses transaksi stok (barang masuk/keluar) untuk Admin.
     * Jika transaksi berhasil, akan mengembalikan flash message 'success'.
     * Jika gagal, akan mengembalikan flash message 'error'.
     */
    public function storeTransaction(Request $request, $type)
    {
        if (!in_array($type, ['Masuk', 'Keluar'])) {
            return response()->json(['error' => 'Invalid transaction type'], 400);
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'notes'      => 'nullable|string'
        ]);

        try {
            $this->productService->updateStock($validated['product_id'], $validated['quantity'], $type, $validated['notes'] ?? '');
            
            // Dispatch event untuk mencatat aktivitas transaksi
            event(new ActivityOccurred(
                auth()->id(),
                "Membuat Transaksi Barang " . $type,
                "Transaksi barang " . $type . " untuk produk ID " . $validated['product_id'] . " dengan jumlah " . $validated['quantity'] . " berhasil dibuat."
            ));

            if ($request->ajax()) {
                return response()->json(['success' => "Transaksi barang {$type} berhasil dibuat."], 200);
            } else {
                return redirect()->back()->with('success', "Transaksi barang {$type} berhasil dibuat.");
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()], 400);
            } else {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    // --- Fungsi CRUD Produk Master untuk Admin (jika masih diperlukan) ---

    public function create()
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('admin.products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|unique:products,sku',
            'description'    => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'selling_price'  => 'required|numeric',
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'image'          => 'nullable|image|max:2048',
            'stock'          => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        if (!isset($validated['stock'])) {
            $validated['stock'] = 0;
        }

        try {
            $product = $this->productService->createProduct($validated);
            
            // Dispatch event untuk mencatat aktivitas pembuatan produk
            event(new ActivityOccurred(
                auth()->id(),
                "Membuat Produk",
                "Produk {$product->name} berhasil ditambahkan."
            ));

            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        $product = $this->productService->getProduct($id);
        $categories = Category::all();
        $suppliers  = Supplier::all();
        return view('admin.products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|unique:products,sku,' . $id,
            'description'    => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'selling_price'  => 'required|numeric',
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
            'image'          => 'nullable|image|max:2048',
            'stock'          => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        try {
            $product = $this->productService->updateProduct($id, $validated);
            
            // Dispatch event untuk mencatat aktivitas update produk
            event(new ActivityOccurred(
                auth()->id(),
                "Memperbarui Produk",
                "Produk {$product->name} berhasil diperbarui."
            ));
            
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        try {
            $this->productService->deleteProduct($id);
            
            // Dispatch event untuk mencatat aktivitas penghapusan produk
            event(new ActivityOccurred(
                auth()->id(),
                "Menghapus Produk",
                "Produk dengan ID {$id} berhasil dihapus."
            ));
            
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function importForm()
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        return view('admin.products.import');
    }
     
    public function import(Request $request)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);
         
        try {
            Excel::import(new \App\Imports\ProductsImport, $request->file('file'));
            return redirect()->route('admin.products.index')->with('success', 'Import produk berhasil.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
     
    public function export()
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        try {
            return Excel::download(new \App\Exports\ProductsExport, 'products.xlsx');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

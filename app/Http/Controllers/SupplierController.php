<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupplierService;
use App\Events\ActivityOccurred; // Import event ActivityOccurred
use App\Models\Product;

class SupplierController extends Controller
{
    protected SupplierService $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Menampilkan daftar supplier.
     * Untuk role Manajer Gudang, tampilkan view read‑only.
     */
    public function index()
    {
        $suppliers = $this->supplierService->getAllSuppliers();
        if (auth()->user()->role === 'Manajer Gudang') {
            return view('manajer.suppliers.index', compact('suppliers'));
        }
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Menampilkan form tambah supplier (hanya untuk Admin).
     */
    public function create()
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        return view('admin.suppliers.create');
    }

    /**
     * Menyimpan supplier baru (hanya untuk Admin).
     */
    public function store(Request $request)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone'   => 'nullable|string',
            'email'   => 'required|email|unique:suppliers,email',
        ]);
        
        $supplier = $this->supplierService->createSupplier($validated);

        // Dispatch event untuk mencatat aktivitas pembuatan supplier
        event(new ActivityOccurred(
            auth()->id(),
            "Membuat Supplier",
            "Supplier '{$supplier->name}' berhasil ditambahkan."
        ));

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit supplier (hanya untuk Admin).
     */
    public function edit($id)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        $supplier = $this->supplierService->getSupplier($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Memperbarui supplier (hanya untuk Admin).
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone'   => 'nullable|string',
            'email'   => 'required|email|unique:suppliers,email,' . $id,
        ]);
        
        $supplier = $this->supplierService->updateSupplier($id, $validated);

        // Dispatch event untuk mencatat aktivitas update supplier
        event(new ActivityOccurred(
            auth()->id(),
            "Memperbarui Supplier",
            "Supplier '{$supplier->name}' berhasil diperbarui."
        ));

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Menghapus supplier (hanya untuk Admin).
     */
    public function destroy($id)
    {
        if (auth()->user()->role === 'Manajer Gudang') {
            abort(403, 'Access Denied');
        }
        // Ambil data supplier sebelum dihapus untuk digunakan dalam log aktivitas
        $supplier = $this->supplierService->getSupplier($id);
        $this->supplierService->deleteSupplier($id);

        // Dispatch event untuk mencatat aktivitas penghapusan supplier
        event(new ActivityOccurred(
            auth()->id(),
            "Menghapus Supplier",
            "Supplier '{$supplier->name}' berhasil dihapus."
        ));

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}

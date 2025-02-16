<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\StockService;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\ActivityOccurred; // Import event ActivityOccurred

class StockController extends Controller
{
    protected StockService $stockService;
    
    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }
    
    public function index()
    {
        $incomingTransactions = $this->stockService->getIncomingTransactions();
        $outgoingTransactions = $this->stockService->getOutgoingTransactions();
        $stockOpnameData      = $this->stockService->getStockOpnameData();
        $transactions         = $this->stockService->getPaginatedTransactions(10);
        $role = auth()->user()->role;
        
        if ($role === 'Manajer Gudang') {
            return view('manajer.stock.index', compact('incomingTransactions', 'outgoingTransactions', 'stockOpnameData', 'transactions'));
        } elseif ($role === 'Staff Gudang') {
            return view('staff.stock.index', compact('transactions'));
        }
        
        return view('admin.stock.index', compact('incomingTransactions', 'outgoingTransactions', 'stockOpnameData', 'transactions'));
    }
    
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'Admin') {
            abort(403, 'Access Denied');
        }
        
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'type'       => 'required|in:Masuk,Keluar',
            'date'       => 'required|date',
            'notes'      => 'nullable|string'
        ]);
        
        try {
            $transaction = $this->stockService->createTransaction($validated);

            // Dispatch event untuk mencatat aktivitas pembuatan transaksi
            event(new ActivityOccurred(
                auth()->id(),
                "Membuat Transaksi {$validated['type']}",
                "Transaksi stok untuk produk ID {$validated['product_id']} dengan jumlah {$validated['quantity']} pada tanggal {$validated['date']} berhasil dibuat."
            ));
            
            return redirect()->route('admin.stock.index')->with('success', 'Transaksi berhasil dibuat');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function updateStatus(Request $request, $id)
    {
        // Izinkan Admin dan Staff Gudang untuk mengupdate status
        if (!in_array(auth()->user()->role, ['Admin', 'Staff Gudang'])) {
            abort(403, 'Access Denied');
        }
        
        $validated = $request->validate([
            'status' => 'required|in:Diterima,Ditolak'
        ]);
        
        try {
            $transaction = $this->stockService->updateTransactionStatus($id, $validated['status']);

            // Dispatch event untuk mencatat aktivitas update status transaksi
            event(new ActivityOccurred(
                auth()->id(),
                "Mengupdate Status Transaksi",
                "Transaksi dengan ID {$id} diubah statusnya menjadi {$validated['status']}."
            ));
            
            if (auth()->user()->role === 'Staff Gudang') {
                return redirect()->route('staff.stock.pending')->with('success', 'Status transaksi berhasil diupdate');
            }
            
            return redirect()->route('admin.stock.index')->with('success', 'Status transaksi berhasil diupdate');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function show($id)
    {
        $transaction = $this->stockService->getTransaction($id);
        $role = auth()->user()->role;
        
        if ($role === 'Manajer Gudang') {
            return view('manajer.stock.show', compact('transaction'));
        } elseif ($role === 'Staff Gudang') {
            return view('staff.stock.show', compact('transaction'));
        }
        
        return view('admin.stock.show', compact('transaction'));
    }
    
    public function settings()
    {
        $products = Product::select('id', 'name', 'stock', 'min_stock')->get();
        $role = auth()->user()->role;
        
        if ($role === 'Manajer Gudang') {
            return view('manajer.stock.settings', compact('products'));
        } elseif ($role === 'Staff Gudang') {
            return view('staff.stock.settings', compact('products'));
        }
        
        return view('admin.stock.settings', compact('products'));
    }

    public function pending()
    {
        $transactions = $this->stockService->getPendingTransactions();
    
        if (auth()->user()->role === 'Staff Gudang') {
            return view('staff.stock.pending', compact('transactions'));
        }
    
        return view('admin.stock.pending', compact('transactions'));
    }

    public function updateStockSettings(Request $request, $id)
    {
        $request->validate([
            'min_stock' => 'required|integer|min:0',
        ]);
    
        // Misalnya, update menggunakan model Product
        $product = \App\Models\Product::findOrFail($id);
        $product->min_stock = $request->input('min_stock');
        $product->save();
    
        return redirect()->route('admin.stock.settings')
                         ->with('success', 'Stok minimum berhasil diperbarui.');
    }
    
       
}

<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\StockRepositoryInterface;

class StockService
{
    protected $stockRepository;
    
    public function __construct(StockRepositoryInterface $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }
    
    public function getAllTransactions()
    {
        return $this->stockRepository->all();
    }
    
    /**
     * Buat transaksi stok berdasarkan tipe.
     * Untuk transaksi masuk, buat record dengan status Pending.
     * Untuk transaksi keluar, buat record dengan status Pending (tanpa langsung mengurangi stok).
     */
    public function createTransaction(array $data)
    {
        $data['user_id'] = auth()->id();
        $data['notes'] = $data['notes'] ?? ''; // Handle null notes
        
        if ($data['type'] === 'Keluar') {
            // TIDAK ADA VALIDASI STOK DI SINI
            return $this->stockRepository->createOutboundTransaction($data);
        } else { // 'Masuk'
            return $this->stockRepository->createIncomingTransaction($data);
        }
    }
    
    public function updateTransactionStatus($id, $status, $receivedAt = null)
    {
        $transaction = $this->stockRepository->find($id);
        
        if ($transaction->type === 'Keluar' && $status === 'Diterima') {
            // Khusus untuk transaksi keluar yang diterima, gunakan verifyOutboundTransaction
            return $this->stockRepository->verifyOutboundTransaction($id, $receivedAt);
        }
        
        // Untuk kasus lain (transaksi masuk atau status ditolak)
        return $this->stockRepository->updateStatus($id, $status, $receivedAt);
    }
    
    public function getPendingTransactions()
    {
        return $this->stockRepository->getPendingTransactions();
    }
    
    public function getTransaction($id)
    {
        return $this->stockRepository->getTransactionById($id);
    }
    
    public function getIncomingTransactions()
    {
        return $this->stockRepository->getIncomingTransactions();
    }
    
    public function getOutgoingTransactions()
    {
        return $this->stockRepository->getOutgoingTransactions();
    }
    
    public function getStockOpnameData()
    {
        $products = Product::select('name', 'stock')->get();
        $data = [];
        foreach ($products as $product) {
            $systemStock   = $product->stock;
            $physicalStock = $systemStock;
            $difference    = $systemStock - $physicalStock;
            $data[] = [
                'product'        => $product->name,
                'system_stock'   => $systemStock,
                'physical_stock' => $physicalStock,
                'difference'     => $difference,
            ];
        }
        return $data;
    }
    
    public function getPaginatedTransactions($perPage = 10)
    {
        return $this->stockRepository->paginateTransactions($perPage);
    }
    
    public function updateMinStock($id, $minStock)
    {
        return $this->stockRepository->updateMinStock($id, $minStock);
    }
    
    public function verifyOutboundTransaction($id, $verifiedAt)
    {
        return $this->stockRepository->verifyOutboundTransaction($id, $verifiedAt);
    }
}
























































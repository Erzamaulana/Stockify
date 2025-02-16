<?php
// app/Services/StockService.php
namespace App\Services;

use App\Models\Product;
use App\Models\StockTransaction;
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

    public function createTransaction(array $data)
    {
        $data['user_id'] = auth()->id();
        $data['status']  = 'Pending';

        // Pastikan field notes ada, walaupun kosong
        if (!isset($data['notes'])) {
            $data['notes'] = '';
        }
    
        // Jika transaksi tipe Keluar, pastikan stok mencukupi
        if ($data['type'] === 'Keluar') {
            $product = Product::findOrFail($data['product_id']);
            if ($product->stock < $data['quantity']) {
                throw new \Exception('Stok tidak mencukupi.');
            }
        }
    
        return $this->stockRepository->create($data);
    }    

    public function updateTransactionStatus($id, $status)
    {
        return $this->stockRepository->updateStatus($id, $status);
    }

    public function getPendingTransactions()
    {
        return $this->stockRepository->getPendingTransactions();
    }
    
    public function getTransaction($id)
    {
        return $this->stockRepository->find($id);
    }

    public function getIncomingTransactions()
    {
        return StockTransaction::with(['product', 'user'])
            ->where('type', 'Masuk')
            ->orderBy('date', 'desc')
            ->get();
    }

    public function getOutgoingTransactions()
    {
        return StockTransaction::with(['product', 'user'])
            ->where('type', 'Keluar')
            ->orderBy('date', 'desc')
            ->get();
    }

    public function getStockOpnameData()
    {
        $products = Product::select('name', 'stock')->get();
        $data = [];
        foreach ($products as $product) {
            $systemStock   = $product->stock;
            $physicalStock = $systemStock; // Asumsi default: tidak ada perbedaan
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
}

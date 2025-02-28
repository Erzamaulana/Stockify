<?php
// app/Services/ProductService.php

namespace App\Services;

use App\Models\StockTransaction;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Exception;

class ProductService
{
    protected ProductRepositoryInterface $productRepository;
    
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    
    public function getAllProducts()
    {
        return $this->productRepository->all();
    }
    
    public function getPaginatedProducts($perPage = 10)
    {
        return $this->productRepository->paginate($perPage);
    }
    
    public function getProduct($id)
    {
        return $this->productRepository->find($id);
    }
    
    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }
    
    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }
    
    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
    
    public function updateStock($productId, int $quantity, string $type = 'Masuk', string $notes = '', $batchNumber = null)
    {
        $product = $this->productRepository->find($productId);
        
        if ($type === 'Masuk') {
            // Hanya menangani transaksi masuk (status Pending)
            \App\Models\StockTransaction::create([
                'product_id'  => $productId,
                'user_id'     => auth()->id(),
                'type'        => 'Masuk',
                'quantity'    => $quantity,
                'date'        => now()->toDateString(),
                'status'      => 'Pending',
                'notes'       => $notes,
                'remaining'   => $quantity,
                'received_at' => null,
                'expiry_date' => null,
                'batch_number'=> $batchNumber,
            ]);
            
            return $product; // Stok produk TIDAK diupdate di sini!
        } else {
            throw new \Exception("Tipe transaksi tidak valid: $type");
        }
    }    
       
    // Method baru untuk mendapatkan produk dengan stok terverifikasi dari stock_transactions
    public function getProductsWithAcceptedStock()
    {
        $productIds = \App\Models\StockTransaction::where('type', 'Masuk')
            ->where('status', 'Diterima')
            ->where('remaining', '>', 0)
            ->pluck('product_id')
            ->unique();
        
        return $this->productRepository->getByIds($productIds);
    }
    
    public function updateMinStock($id, $minStock)
    {
        return $this->productRepository->update($id, ['min_stock' => $minStock]);
    }
}


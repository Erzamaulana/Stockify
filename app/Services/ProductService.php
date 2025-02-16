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
    
    /**
     * Mengambil semua produk.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        return $this->productRepository->all();
    }
    
    /**
     * Mengambil produk dengan pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedProducts($perPage = 10)
    {
        return $this->productRepository->paginate($perPage);
    }
    
    /**
     * Mengambil satu produk berdasarkan ID.
     *
     * @param int $id
     * @return \App\Models\Product
     */
    public function getProduct($id)
    {
        return $this->productRepository->find($id);
    }
    
    /**
     * Membuat produk baru.
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function createProduct(array $data)
    {
        // Tempat untuk validasi atau logika bisnis tambahan 
        return $this->productRepository->create($data);
    }
    
    /**
     * Memperbarui produk yang ada.
     *
     * @param int   $id
     * @param array $data
     * @return \App\Models\Product
     */
    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }
    
    /**
     * Menghapus produk.
     *
     * @param int $id
     * @return bool|null
     */
    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }
    
    /**
     * Memperbarui stok produk.
     *
     * @param int    $productId
     * @param int    $quantity
     * @param string $type 'in' untuk penambahan, 'out' untuk pengurangan.
     * @throws Exception Jika stok tidak mencukupi atau tipe tidak valid.
     * @return \App\Models\Product
     */
    public function updateStock($productId, int $quantity, string $type = 'Masuk', string $notes = '')
    {
        $product = $this->productRepository->find($productId);
        
        if ($type === 'Keluar') {
            if ($product->stock < $quantity) {
                throw new \Exception('Insufficient stock');
            }
            
            $batches = \App\Models\StockTransaction::where('product_id', $productId)
                        ->where('type', 'Masuk')
                        ->where('remaining', '>', 0)
                        ->orderBy('received_at', 'asc')
                        ->get();
                            
            $remainingQtyToDeduct = $quantity;
                
            foreach ($batches as $batch) {
                if ($remainingQtyToDeduct <= 0) {
                    break;
                }
                if ($batch->remaining >= $remainingQtyToDeduct) {
                    $batch->remaining -= $remainingQtyToDeduct;
                    $batch->save();
                    $remainingQtyToDeduct = 0;
                } else {
                    $remainingQtyToDeduct -= $batch->remaining;
                    $batch->remaining = 0;
                    $batch->save();
                }
            }
                
            if ($remainingQtyToDeduct > 0) {
                throw new \Exception('FIFO error: Not enough stock available in batches.');
            }
                
            $newStock = $product->stock - $quantity;
        } elseif ($type === 'Masuk') {
            $newStock = $product->stock + $quantity;
            
            StockTransaction::create([
                'product_id'  => $productId,
                'user_id'     => auth()->id(),
                'type'        => 'Masuk',
                'quantity'    => $quantity,
                'date'        => now()->toDateString(),
                'status'      => 'Pending',
                'notes'       => $notes, // sekarang $notes sudah tersedia
                'remaining'   => $quantity,
                'received_at' => null,
            ]);
        } else {
            throw new \Exception("Invalid stock update type: $type");
        }
        
        $updatedProduct = $this->productRepository->update($productId, ['stock' => $newStock]);
        
        // Untuk transaksi keluar, catat transaksi keluar
        if ($type === 'Keluar') {
            \App\Models\StockTransaction::create([
                'product_id'  => $productId,
                'user_id'     => auth()->id(),
                'type'        => 'Keluar',
                'quantity'    => $quantity,
                'date'        => now()->toDateString(),
                'status'      => 'Dikeluarkan',
                'notes'       => '', // atau jika perlu, gunakan $notes juga
                'remaining'   => 0,
                'received_at' => null,
            ]);
        }
        
        return $updatedProduct;
    }    
}

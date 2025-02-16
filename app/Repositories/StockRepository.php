<?php
// app/Repositories/StockRepository.php
namespace App\Repositories;

use App\Models\StockTransaction;
use App\Models\Product;
use App\Repositories\Interfaces\StockRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StockRepository implements StockRepositoryInterface
{
    protected $model;
    protected $product;
    
    public function __construct(StockTransaction $model, Product $product)
    {
        $this->model = $model;
        $this->product = $product;
    }

    public function all()
    {
        return $this->model->with(['product', 'user'])->get();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $transaction = $this->model->create($data);

            if ($data['status'] === 'Diterima' && $data['type'] === 'Masuk') {
                $this->updateProductStock($data['product_id'], $data['quantity'], 'add');
            } elseif ($data['status'] === 'Dikeluarkan' && $data['type'] === 'Keluar') {
                $this->updateProductStock($data['product_id'], $data['quantity'], 'subtract');
            }

            return $transaction;
        });
    }

    public function updateStatus($id, $status)
    {
        return DB::transaction(function () use ($id, $status) {
            $transaction = $this->model->findOrFail($id);
            $transaction->status = $status;
            $transaction->save();

            if ($status === 'Diterima' && $transaction->type === 'Masuk') {
                $this->updateProductStock($transaction->product_id, $transaction->quantity, 'add');
            } elseif ($status === 'Dikeluarkan' && $transaction->type === 'Keluar') {
                $this->updateProductStock($transaction->product_id, $transaction->quantity, 'subtract');
            }

            return $transaction;
        });
    }

    public function getPendingTransactions()
{
    return $this->model->where('status', 'Pending')
                       ->with(['product', 'user'])
                       ->get();
}


    public function find($id)
    {
        return $this->model->with(['product', 'user'])->findOrFail($id);
    }

    protected function updateProductStock($productId, $quantity, $operation)
    {
        $product = $this->product->findOrFail($productId);
        
        if ($operation === 'add') {
            $product->stock += $quantity;
        } else {
            if ($product->stock < $quantity) {
                throw new \Exception('Stok tidak mencukupi');
            }
            $product->stock -= $quantity;
        }

        $product->save();
    }

    public function getIncomingTransactions()
    {
        return $this->model->where('type', 'Masuk')
                           ->with(['product', 'user'])
                           ->orderBy('date', 'desc')
                           ->get();
    }

    public function getOutgoingTransactions()
    {
        return $this->model->where('type', 'Keluar')
                           ->with(['product', 'user'])
                           ->orderBy('date', 'desc')
                           ->get();
    }

    public function getStockOpnameData()
    {
        return $this->product->select('id', 'name', 'stock')->get()->map(function ($product) {
            return [
                'product'        => $product->name,
                'system_stock'   => $product->stock,
                'physical_stock' => $product->stock,
                'difference'     => 0,
            ];
        });
    }

    public function paginateTransactions($perPage = 10)
    {
        return $this->model->with(['product', 'user'])
                           ->orderBy('date', 'desc')
                           ->paginate($perPage);
    }

    // Opsional: implementasi method getTransactions sebagai alias dari all()
    public function getTransactions()
    {
        return $this->all();
    }

    public function updateMinStock($id, $minStock)
{
    // Menggunakan model Product (yang sudah disuntikkan sebagai $this->product)
    $product = $this->product->findOrFail($id);
    $product->min_stock = $minStock;
    $product->save();

    return $product;
}
}

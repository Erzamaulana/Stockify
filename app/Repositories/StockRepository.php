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

    /**
     * Buat transaksi masuk baru.
     * Transaksi masuk dibuat dengan status "Pending" tanpa mengupdate stok produk.
     */
    public function createIncomingTransaction(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Pastikan status untuk transaksi masuk adalah "Pending"
            $data['status'] = 'Pending';
            $transaction = $this->model->create($data);
            // Jangan update stok produk di sini; stok akan diupdate saat verifikasi (status diubah ke "Diterima")
            return $transaction;
        });
    }

    /**
     * Proses transaksi keluar menggunakan metode FIFO.
     * Logika: 
     *  - Cek apakah stok produk mencukupi.
     *  - Ambil batch transaksi masuk (dengan status "Diterima") untuk produk tersebut, diurutkan berdasarkan received_at (FIFO).
     *  - Kurangi field 'remaining' pada tiap batch sesuai kebutuhan hingga jumlah pengeluaran terpenuhi.
     *  - Buat record transaksi keluar dan update stok produk.
     */
    public function processOutgoingTransaction(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->product->findOrFail($data['product_id']);
            
            if ($product->stock < $data['quantity']) {
                throw new \Exception('Stok tidak mencukupi untuk transaksi keluar');
            }
            
            // Ambil batch transaksi masuk dengan status "Diterima" dan remaining > 0 secara FIFO (received_at ascending)
            $batches = $this->model->where('product_id', $data['product_id'])
                        ->where('type', 'Masuk')
                        ->where('status', 'Diterima')
                        ->where('remaining', '>', 0)
                        ->orderBy('received_at', 'asc')
                        ->get();
                        
            $qtyToDeduct = $data['quantity'];
            
            foreach ($batches as $batch) {
                if ($batch->remaining >= $qtyToDeduct) {
                    $batch->remaining -= $qtyToDeduct;
                    $batch->save();
                    $qtyToDeduct = 0;
                    break;
                } else {
                    $qtyToDeduct -= $batch->remaining;
                    $batch->remaining = 0;
                    $batch->save();
                }
            }
            
            // Jika masih ada sisa, berarti stok tidak mencukupi, meskipun pengecekan awal lolos (untuk jaga-jaga)
            if ($qtyToDeduct > 0) {
                throw new \Exception('Terjadi kesalahan pada pengurangan stok batch.');
            }
            
            // Buat record transaksi keluar dengan status "Dikeluarkan"
            $outTransaction = $this->model->create([
                'product_id' => $data['product_id'],
                'user_id'    => $data['user_id'] ?? auth()->id(),
                'type'       => 'Keluar',
                'quantity'   => $data['quantity'],
                'remaining'  => 0, // Untuk transaksi keluar, remaining dianggap 0
                'date'       => $data['date'],
                'status'     => 'Dikeluarkan',
                'notes'      => $data['notes'] ?? null,
            ]);
            
            // Update stok produk di tabel products
            $this->updateProductStock($data['product_id'], $data['quantity'], 'subtract');
            
            return $outTransaction;
        });
    }

    /**
     * Mengubah status transaksi.
     * Method ini terutama untuk transaksi masuk.
     * Bila status diubah menjadi "Diterima" untuk transaksi masuk, stok produk akan ditambahkan.
     */
    public function updateStatus($id, $status, $receivedAt = null)
    {
        return DB::transaction(function () use ($id, $status, $receivedAt) {
            $transaction = $this->model->findOrFail($id);
            $transaction->status = $status;
            
            if ($transaction->type === 'Masuk' && $status === 'Diterima') {
                // Pastikan received_at diisi (gunakan $receivedAt atau fallback ke waktu sekarang)
                $transaction->received_at = $receivedAt ? $receivedAt : now();
                // Set remaining sesuai quantity (jika diperlukan)
                $transaction->remaining = $transaction->quantity;
                // Update stok produk sesuai transaksi masuk yang diterima
                $this->updateProductStock($transaction->product_id, $transaction->quantity, 'add');
            }
            
            // Untuk status Ditolak, tidak perlu update received_at atau stok produk
            
            $transaction->save();
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
        $product = $this->product->findOrFail($id);
        $product->min_stock = $minStock;
        $product->save();
        return $product;
    }
    public function verifyOutboundTransaction($id, $verifiedAt)
    {
        return DB::transaction(function () use ($id, $verifiedAt) {
            $transaction = $this->model->findOrFail($id);
            
            // Validasi 1: Status harus Pending
            if ($transaction->status !== 'Pending') {
                throw new \Exception("Transaksi harus dalam status Pending.");
            }
            
            // Validasi 2: Tipe harus Keluar
            if ($transaction->type !== 'Keluar') {
                throw new \Exception("Hanya transaksi keluar yang bisa diverifikasi.");
            }
            
            // Ambil semua batch masuk yang valid
            $batches = $this->model->where('product_id', $transaction->product_id)
                        ->where('type', 'Masuk')
                        ->where('status', 'Diterima')
                        ->where('remaining', '>', 0)
                        ->orderBy('received_at', 'asc')
                        ->get();
            
            // Validasi 3: Total stok batch harus mencukupi
            $totalAvailable = $batches->sum('remaining');
            if ($totalAvailable < $transaction->quantity) {
                throw new \Exception("Stok batch tidak mencukupi. Tersedia: {$totalAvailable}, Dibutuhkan: {$transaction->quantity}");
            }
            
            // Proses FIFO
            $remainingQtyToDeduct = $transaction->quantity;
            foreach ($batches as $batch) {
                if ($remainingQtyToDeduct <= 0) break;
                
                $deductAmount = min($batch->remaining, $remainingQtyToDeduct);
                $batch->decrement('remaining', $deductAmount);
                $remainingQtyToDeduct -= $deductAmount;
            }
            
            // Update stok produk
            $this->updateProductStock(
                $transaction->product_id,
                $transaction->quantity,
                'subtract'
            );
            
            // Update status transaksi
            $transaction->update([
                'status' => 'Dikeluarkan',
                'received_at' => $verifiedAt
            ]);
            
            return $transaction;
        });
    }
    public function createOutboundTransaction(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Hanya buat transaksi tanpa validasi stok
            return $this->model->create([
                'product_id' => $data['product_id'],
                'user_id'    => $data['user_id'] ?? auth()->id(),
                'type'       => 'Keluar',
                'quantity'   => $data['quantity'],
                'remaining'  => 0,
                'date'       => $data['date'],
                'status'     => 'Pending', // Pastikan status Pending
                'notes'      => $data['notes'] ?? null,
            ]);
        });
    }
}
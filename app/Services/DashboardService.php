<?php

namespace App\Services;

use App\Repositories\Interfaces\DashboardRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\StockTransaction;

class DashboardService
{
    protected $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getPaginatedDashboard($perPage = 5)
    {
        return $this->dashboardRepository->paginate($perPage);
    }

    public function getDashboardData()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate   = Carbon::now()->endOfMonth();
        $products = Product::select('name', 'stock')->get();
        $labels = $products->pluck('name')->toArray();
        $data = $products->pluck('stock')->toArray();

        return [
            'total_products'      => $this->dashboardRepository->getTotalProducts(),
            'recent_transactions' => $this->dashboardRepository->getRecentTransactions(),
            'monthly_transactions'=> $this->dashboardRepository->getTransactionsByPeriod($startDate, $endDate),
            'low_stock_products'  => $this->dashboardRepository->getLowStockProducts(),
            'stock_summary'       => $this->formatStockSummaryForChart($this->dashboardRepository->getStockSummary()),
            'recent_activities'   => $this->dashboardRepository->getRecentUserActivities(),
            'labels' => $labels,
            'data'   => $data,
        ];
    }

    protected function formatStockSummaryForChart($stockSummary)
    {
        $formattedData = [];
        foreach ($stockSummary as $item) {
            $formattedData[] = [
                'date'     => $item->transaction_date,
                'type'     => $item->type,
                'quantity' => $item->total_quantity,
            ];
        }
        return $formattedData;
    }

    // Tambahkan metode ini untuk menghitung jumlah produk per kategori
    public function getProductCountsByCategory()
    {
        $counts = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->pluck('total', 'category');

        return $counts;
    }

     // Method khusus untuk Dashboard Manajer Gudang
     public function getDashboardDataForManager(Carbon $startOfDay, Carbon $endOfDay)
     {
         // Contoh: Produk dengan stok menipis
         $lowStockProducts = Product::whereColumn('stock', '<=', 'min_stock')->get();
 
         // Contoh: Total barang masuk hari ini (misalnya, di tabel stock_transactions dengan type 'Masuk')
         $incomingToday = StockTransaction::where('type', 'Masuk')
                             ->whereBetween('created_at', [$startOfDay, $endOfDay])
                             ->sum('quantity');
 
         // Contoh: Total barang keluar hari ini (type 'Keluar')
         $outgoingToday = StockTransaction::where('type', 'Keluar')
                             ->whereBetween('created_at', [$startOfDay, $endOfDay])
                             ->sum('quantity');
 
         return [
             'low_stock'  => $lowStockProducts,
             'incoming'   => $incomingToday,
             'outgoing'   => $outgoingToday,
         ];
     }

     public function getDashboardDataForStaff()
     {
         // Contoh: Ambil transaksi stok dengan status 'Pending'
         $pendingTransactions = StockTransaction::where('status', 'Pending')
                                     ->with(['product'])
                                     ->get();
         return [
              'pending' => $pendingTransactions,
         ];
     }

}

<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\ActivityLog;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    protected $product;
    protected $stockTransaction;
    protected $activityLog;

    // Tambahkan ActivityLog sebagai parameter ketiga
    public function __construct(Product $product, StockTransaction $stockTransaction, ActivityLog $activityLog)
    {
        $this->product = $product;
        $this->stockTransaction = $stockTransaction;
        $this->activityLog = $activityLog; 
    }

    public function getTotalProducts()
    {
        return $this->product->count();
    }

    public function getRecentTransactions($limit = 5)
    {
        return $this->stockTransaction
            ->with(['product', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getTransactionsByPeriod($startDate, $endDate)
    {
        return $this->stockTransaction
            ->whereBetween('date', [$startDate, $endDate])
            ->select(
                'type',
                DB::raw('COUNT(*) as total_transactions'),
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->groupBy('type')
            ->get();
    }

    public function getLowStockProducts()
    {
        return $this->product
            ->whereColumn('stock', '<=', 'min_stock')
            ->get();
    }

    public function getStockSummary()
    {
        return $this->stockTransaction
            ->select(
                DB::raw('DATE(date) as transaction_date'),
                'type',
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->groupBy('transaction_date', 'type')
            ->orderBy('transaction_date')
            ->get();
    }

    public function getRecentUserActivities($limit = 5)
    {
        return $this->activityLog
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    // Method paginate untuk ActivityLog
    public function paginate($perPage = 5)
    {
        return $this->activityLog
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}

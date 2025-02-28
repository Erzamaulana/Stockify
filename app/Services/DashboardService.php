<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
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
        $endDate = Carbon::now()->endOfMonth();
        $products = Product::select('name', 'stock')->get();
        
        return [
            'total_products' => $this->dashboardRepository->getTotalProducts(),
            'incoming_transactions' => $this->dashboardRepository->getTransactionCount('Masuk'),
            'outgoing_transactions' => $this->dashboardRepository->getTransactionCount('Keluar'),
            'low_stock_count' => $this->dashboardRepository->getLowStockCount(),
            'recent_transactions' => $this->dashboardRepository->getRecentTransactions(),
            'monthly_transactions' => $this->dashboardRepository->getTransactionsByPeriod($startDate, $endDate),
            'low_stock_products' => $this->dashboardRepository->getLowStockProducts(),
            'stock_summary' => $this->formatStockSummaryForChart($this->dashboardRepository->getStockSummary()),
            'recent_activities' => $this->dashboardRepository->getRecentUserActivities(),
            'labels' => $products->pluck('name')->toArray(),
            'data' => $products->pluck('stock')->toArray(),
        ];
    }

    protected function formatStockSummaryForChart($stockSummary)
    {
        $formattedData = [];
        foreach ($stockSummary as $item) {
            $formattedData[] = [
                'date' => $item->transaction_date,
                'type' => $item->type,
                'quantity' => $item->total_quantity,
            ];
        }
        return $formattedData;
    }

    public function getProductCountsByCategory()
    {
        return DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category', DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->pluck('total', 'category');
    }

    public function getDashboardDataForManager(Carbon $startOfDay, Carbon $endOfDay)
    {
        return [
            'low_stock' => $this->dashboardRepository->getLowStockProducts(),
            'incoming' => $this->dashboardRepository->getDailyTransactions($startOfDay, $endOfDay, 'Masuk'),
            'outgoing' => $this->dashboardRepository->getDailyTransactions($startOfDay, $endOfDay, 'Keluar'),
        ];
    }

    public function getDashboardDataForStaff()
    {
        return [
            'pending' => StockTransaction::where('status', 'Pending')
                ->with(['product'])
                ->get(),
        ];
    }
}
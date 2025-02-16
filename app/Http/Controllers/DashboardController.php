<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\StockTransaction;

class DashboardController extends Controller
{
    protected $dashboardService;
    
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    
    /**
     * Dashboard Admin
     */
    public function index()
    {
        // Ambil ActivityLog yang sudah dipaginate melalui service
        $recentActivities = $this->dashboardService->getPaginatedDashboard(5);

        $dashboardData = [
            'total_products' => Product::count(),
            // Data ringkasan lainnya...
            'recent_transactions' => StockTransaction::with(['product'])
                                          ->orderBy('created_at', 'desc')
                                          ->limit(5)
                                          ->get(),
            'labels' => Product::pluck('name'),
            'data'   => Product::pluck('stock'),
        ];
        
        return view('admin.dashboard', compact('dashboardData', 'recentActivities'));
    }
    
    /**
     * Dashboard Manajer Gudang
     */
    public function managerDashboard()
    {
        $startOfDay = Carbon::today();
        $endOfDay   = Carbon::today()->endOfDay();

        // Menggunakan method dari DashboardService untuk data khusus manajer
        $data = $this->dashboardService->getDashboardDataForManager($startOfDay, $endOfDay);

        return view('manajer.dashboard', compact('data'));
    }
    
    /**
     * Dashboard Staff
     */
    public function staffDashboard(Request $request)
    {
        $dashboardData = $this->dashboardService->getDashboardDataForStaff();
        return view('staff.dashboard', compact('dashboardData'));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Services\DashboardService;
use Illuminate\Http\Request;
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
        $recentActivities = $this->dashboardService->getPaginatedDashboard(5);
        $dashboardData = $this->dashboardService->getDashboardData();
        
        return view('admin.dashboard', compact('dashboardData', 'recentActivities'));
    }
    
    /**
     * Dashboard Manajer Gudang
     */
    public function managerDashboard()
    {
        $startOfDay = Carbon::today();
        $endOfDay = Carbon::today()->endOfDay();
        $data = $this->dashboardService->getDashboardDataForManager($startOfDay, $endOfDay);
        
        return view('manajer.dashboard', compact('data'));
    }
    
    /**
     * Dashboard Staff
     */
    public function staffDashboard()
    {
        $dashboardData = $this->dashboardService->getDashboardDataForStaff();
        return view('staff.dashboard', compact('dashboardData'));
    }
}
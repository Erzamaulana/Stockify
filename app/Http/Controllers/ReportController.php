<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Models\Category;
use App\Models\User;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(Request $request)
{
    $startDate  = $request->get('start_date') ?? now()->startOfMonth()->toDateString();
    $endDate    = $request->get('end_date') ?? now()->endOfMonth()->toDateString();
    $categoryId = $request->get('category_id') ?? null;
    $userId     = $request->get('user_id') ?? null;

    // Ambil data laporan dari service
    $stockReport       = $this->reportService->getStockReport($startDate, $endDate, $categoryId) ?? collect();
    $transactionReport = $this->reportService->getTransactionReport($startDate, $endDate) ?? collect();
    $userActivity      = $this->reportService->getUserActivityReport($userId, $startDate, $endDate) ?? collect();

    $categories = Category::all() ?? collect();
    $users      = User::all() ?? collect();

    // Cek role pengguna dan arahkan ke view yang sesuai
    if (auth()->user()->role === 'Manajer Gudang') {
        return view('manajer.reports.index', compact(
            'stockReport',
            'transactionReport',
            'userActivity',
            'categories',
            'users',
            'startDate',
            'endDate',
            'categoryId',
            'userId'
        ));
    }

    return view('admin.reports.index', compact(
        'stockReport',
        'transactionReport',
        'userActivity',
        'categories',
        'users',
        'startDate',
        'endDate',
        'categoryId',
        'userId'
    ));
}
}

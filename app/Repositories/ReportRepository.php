<?php

namespace App\Repositories;

use App\Models\StockTransaction; // Atau model aktivitas pengguna jika berbeda
use App\Repositories\Interfaces\ReportRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportRepository implements ReportRepositoryInterface
{
    public function getStockReport($startDate, $endDate, $categoryId = null)
    {
        // Implementasi laporan stok
    }

    public function getTransactionReport($startDate, $endDate)
    {
        // Implementasi laporan transaksi
    }
    
    public function getUserActivityReport($userId = null, $startDate = null, $endDate = null)
{
    $query = DB::table('activity_logs')
        ->join('users', 'activity_logs.user_id', '=', 'users.id')
        ->select('users.name as user_name', DB::raw('DATE(activity_logs.created_at) as date'), 'activity');

    if ($userId) {
        $query->where('activity_logs.user_id', $userId);
    }
    if ($startDate && $endDate) {
        $query->whereBetween('activity_logs.created_at', [$startDate, $endDate]);
    }
    return $query->orderBy('activity_logs.created_at', 'desc')->get();
}
}

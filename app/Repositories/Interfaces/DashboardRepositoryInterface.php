<?php

namespace App\Repositories\Interfaces;

interface DashboardRepositoryInterface
{
    public function getTotalProducts();
    public function getRecentTransactions($limit = 5);
    public function getTransactionsByPeriod($startDate, $endDate);
    public function getLowStockProducts();
    public function getStockSummary();
    public function getRecentUserActivities($limit = 5);
    public function paginate($perPage = 5);
}

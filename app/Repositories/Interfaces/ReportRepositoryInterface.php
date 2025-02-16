<?php
// app/Repositories/Interfaces/ReportRepositoryInterface.php
namespace App\Repositories\Interfaces;

interface ReportRepositoryInterface
{
    public function getStockReport($startDate, $endDate, $categoryId = null);
    public function getTransactionReport($startDate, $endDate);
    public function getUserActivityReport($userId = null, $startDate = null, $endDate = null);
}
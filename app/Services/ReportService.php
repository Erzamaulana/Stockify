<?php
// app/Services/ReportService.php
namespace App\Services;

use App\Repositories\Interfaces\ReportRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Excel;

class ReportService
{
    protected $reportRepository;

    public function __construct(ReportRepositoryInterface $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    // Method untuk laporan stok barang (contoh sudah ada)
    public function getStockReport($startDate, $endDate, $categoryId = null)
    {
        $startDate = Carbon::parse($startDate);
        $endDate   = Carbon::parse($endDate);
        return $this->reportRepository->getStockReport($startDate, $endDate, $categoryId);
    }

    // Tambahkan method getUserActivityReport()
    public function getUserActivityReport($userId = null, $startDate = null, $endDate = null)
    {
        // Jika tanggal tidak diberikan, atur default (misalnya, bulan ini)
        $startDate = $startDate ? Carbon::parse($startDate) : Carbon::now()->startOfMonth();
        $endDate   = $endDate ? Carbon::parse($endDate) : Carbon::now()->endOfMonth();
        
        return $this->reportRepository->getUserActivityReport($userId, $startDate, $endDate);
    }

    // Misalnya, juga ada method untuk laporan transaksi:
    public function getTransactionReport($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate   = Carbon::parse($endDate);
        return $this->reportRepository->getTransactionReport($startDate, $endDate);
    }
}
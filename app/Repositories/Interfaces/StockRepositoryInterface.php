<?php
namespace App\Repositories\Interfaces;

interface StockRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function updateStatus($id, $status);
    public function getPendingTransactions();
    public function find($id);
    public function getIncomingTransactions();
    public function getOutgoingTransactions();
    public function paginateTransactions($perPage = 10);
    public function getTransactions();
    public function updateMinStock($id, $minStock);
}

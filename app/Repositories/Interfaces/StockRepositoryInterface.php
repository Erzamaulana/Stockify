<?php
namespace App\Repositories\Interfaces;

interface StockRepositoryInterface
{
    public function all();
    public function createIncomingTransaction(array $data);
    public function createOutboundTransaction(array $data);
    public function updateStatus($id, $status, $receivedAt = null);
    public function getPendingTransactions();
    public function find($id);
    public function getIncomingTransactions();
    public function getOutgoingTransactions();
    public function paginateTransactions($perPage = 10);
    public function getTransactions();
    public function updateMinStock($id, $minStock);
    public function verifyOutboundTransaction($id, $verifiedAt);
}
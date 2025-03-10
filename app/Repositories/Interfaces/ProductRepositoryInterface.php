<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface 
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByCategory($categoryId);
    public function paginate($perPage = 10);
    
    // Method baru untuk mengambil produk berdasarkan array ID
    public function getByIds($ids);
}

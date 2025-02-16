<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;
    
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    
    public function all()
    {
        return $this->model->all();
    }
    
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
    
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    
    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }
    
    public function delete($id)
    {
        return $this->find($id)->delete();
    }
    
    public function findByCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->get();
    }
    
    // Tambahkan method untuk pagination
    public function paginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }
}

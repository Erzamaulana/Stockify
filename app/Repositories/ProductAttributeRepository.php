<?php

namespace App\Repositories;

use App\Models\ProductAttribute;
use App\Repositories\Interfaces\ProductAttributeRepositoryInterface;

class ProductAttributeRepository implements ProductAttributeRepositoryInterface
{
    protected $model;

    public function __construct(ProductAttribute $model)
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
        $attribute = $this->find($id);
        $attribute->update($data);
        return $attribute;
    }
    
    public function delete($id)
    {
        return $this->find($id)->delete();
    }
    
    public function findByProduct($productId)
    {
        return $this->model->where('product_id', $productId)->get();
    }
}

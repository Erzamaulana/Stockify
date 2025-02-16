<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductAttributeRepositoryInterface;
use App\Models\ProductAttribute;

class ProductAttributeService
{
    protected $attributeRepository;
    
    public function __construct(ProductAttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }
    
    public function getAttributesByProduct($productId)
    {
        return $this->attributeRepository->findByProduct($productId);
    }
    
    public function createAttribute(array $data)
    {
        return $this->attributeRepository->create($data);
    }
    
    public function updateAttribute($id, array $data)
    {
        return $this->attributeRepository->update($id, $data);
    }
    
    public function deleteAttribute($id)
    {
        return $this->attributeRepository->delete($id);
    }

        public function all()
    {
        return $this->attributeRepository->all();
    }

        public function getAttribute($id)
    {
        return ProductAttribute::findOrFail($id);
    }
}

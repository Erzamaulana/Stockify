<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'description',
        'purchase_price',
        'selling_price',
        'image',
        'stock',

    ];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(category::class);
    }

    // Relasi ke Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


    public function stockTransactions()
{
    return $this->hasMany(StockTransaction::class, 'product_id');
}

public function products()
{
    return $this->hasMany(Product::class, 'category_id'); // Sesuaikan dengan foreign key di tabel products
}

public function attributes()
{
    return $this->hasMany(ProductAttribute::class);
}

}
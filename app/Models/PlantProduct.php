<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantProduct extends Model
{
    use HasFactory;

    protected $table = 'plantproducts';

    protected $fillable = ['name', 'description', 'price', 'plant_id'];

    // Define relationship with Plant
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    // Define relationship with Categories
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category');
    }

    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_productcategory', 'product_id', 'category_id');
    }

    // Define relationship with OrderItems (Product is linked to orders via OrderItems)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'plant_product_id');
    }

    // Define relationship with Orders through OrderItems
    public function orders()
    {
        return $this->hasManyThrough(
            Order::class, // Target Model
            OrderItem::class, // Intermediate Model
            'plant_product_id', // Foreign key in OrderItem referring to PlantProduct
            'id', // Local key in Order
            'id', // Local key in PlantProduct
            'order_id' // Foreign key in OrderItem referring to Order
        );
    }
}

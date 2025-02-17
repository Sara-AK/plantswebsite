<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantProduct extends Model
{

    protected $table = 'plantproducts';

    protected $fillable = ['name', 'description', 'price', 'plant_id'];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category');
    }
    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_productcategory', 'product_id', 'category_id');
    }


}


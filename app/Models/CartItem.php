<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items'; // Matches MySQL table name

    protected $fillable = ['user_id', 'plant_product_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(PlantProduct::class, 'plant_product_id');
    }
}

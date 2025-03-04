<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status'];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Order Items (Order has many OrderItems)
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    // Define relationship with Plant Products via OrderItems
    public function plantProducts()
    {
        return $this->hasManyThrough(
            PlantProduct::class, // Target Model
            OrderItem::class, // Intermediate Model
            'order_id', // Foreign key in OrderItem referring to Order
            'id', // Local key in PlantProduct
            'id', // Local key in Order
            'plant_product_id' // Foreign key in OrderItem referring to PlantProduct
        );
    }
}

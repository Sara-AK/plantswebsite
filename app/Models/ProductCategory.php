<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    // No need for `$fillable` if you're using a pivot table
    protected $table = 'product_categories'; // If your table name is different, set it here

    // You can define relationships if needed for example:
    public function products()
    {
        return $this->belongsToMany(PlantProduct::class, 'product_category');
    }


}

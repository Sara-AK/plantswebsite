<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantCategory extends Model
{
    protected $table = 'plantcategories'; // Explicitly define the table name
    protected $fillable = ['name', 'description'];

    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'category_plant');
    }
}



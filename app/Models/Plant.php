<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = ['name', 'description', 'pictures', 'caredifficulty', 'caretips'];
    protected $casts = [
        'pictures' => 'array', // Automatically cast JSON to an array
    ];


    public function categories()
    {
        return $this->belongsToMany(PlantCategory::class, 'category_plant', 'plant_id', 'plantcategory_id');
    }



    public function regions()
    {
        return $this->belongsToMany(Region::class, 'plant_region', 'plant_id', 'region_id');
    }


    public function products()
    {
        return $this->hasMany(PlantProduct::class, 'plant_id');
    }

}


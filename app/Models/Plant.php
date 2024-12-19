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
        return $this->belongsToMany(PlantCategory::class, 'category_plant');
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'plant_region');
    }

    public function products()
    {
        return $this->hasMany(PlantProduct::class);
    }
}


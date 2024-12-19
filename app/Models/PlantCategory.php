<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantCategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'category_plant');
    }
}


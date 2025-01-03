<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name'];

    public function plants()
    {
        return $this->belongsToMany(Plant::class, 'plant_region', 'region_id', 'plant_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GardenerRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'gardener_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function gardener()
    {
        return $this->belongsTo(Gardener::class);
    }
}

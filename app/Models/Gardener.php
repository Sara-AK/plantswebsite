<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gardener extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'bio'];

    public function requests()
    {
        return $this->hasMany(GardenerRequest::class);
    }
    public function isRequestedBy($user)
    {
        return $this->requests()->where('user_id', $user->id)->exists();
    }

}

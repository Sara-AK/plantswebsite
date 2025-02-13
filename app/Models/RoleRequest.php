<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'requested_role',
        'status',
        'request_note',
        'cv_file',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }
}

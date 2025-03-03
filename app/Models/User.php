<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Message;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roleRequests()
    {
        return $this->hasOne(RoleRequest::class, 'user_id')->latest();
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function gardenerRequests()
    {
        return $this->hasMany(GardenerRequest::class, 'user_id');
    }

    public function isRequestedBy(User $user)
    {
        return GardenerRequest::where('user_id', $user->id)
            ->where('gardener_id', $this->id)
            ->exists();
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(GardenerRequest::class, 'gardener_id');
    }



}

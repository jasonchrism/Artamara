<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'phone_number',
        'role',
        'profile_picture',
        'id_photo',
        'status',
        'about'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "users";
    protected $primaryKey = 'user_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    public function order(): HasMany {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    public function userAdress(): HasMany {
        return $this->hasMany(UserAddress::class, 'user_id', 'user_id');
    }

    public function cart(): HasMany {
        return $this->hasMany(Cart::class, 'user_id', 'user_id');
    }

    public function bid(): HasMany {
        return $this->hasMany(Bid::class, 'user_id', 'user_id');
    }

    public function product(): HasMany {
        return $this->hasMany(Product::class, 'user_id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [
        'address_id',
    ];

    protected $table = "addresses";
    protected $primaryKey = 'address_id';
    protected $keyType = 'string';

    public function userAddress(): HasOne {
        return $this->hasOne(UserAddress::class, 'address_id', 'address_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;

class UserAddress extends Model
{
    use HasFactory;
    use HasCompositeKey;

    protected $primaryKey = ['address_id', 'user_id'];
    protected $fillable = [
    'address_id',
    'user_id',
    'is_default',
    ];

    protected $table = "user_addresses";

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function userAddress(): BelongsTo {
        return $this->belongsTo(Address::class, 'address_id', 'address_id');
    }
}

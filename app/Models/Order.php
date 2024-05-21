<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'order_id',
    ];

    protected $table = "orders";
    protected $primaryKey = 'order_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function payment(): BelongsTo {
        return $this->belongsTo(Payment::class, 'payment_id', 'payment_id');
    }

    public function userAddress(): BelongsTo {
        return $this->belongsTo(UserAddress::class, 'address_id', 'address_id');
    }

    public function orderDetail(): HasMany {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function refund(): HasOne {
        return $this->hasOne(Refund::class, 'product_id', 'product_id');
    }

    public function review(): HasOne {
        return $this->hasOne(Review::class, 'product_id', 'product_id');
    }
}

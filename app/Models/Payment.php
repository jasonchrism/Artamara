<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'payment_id',
    ];

    protected $table = "payments";
    protected $primaryKey = 'payment_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    public function order(): HasOne {
        return $this->hasOne(Order::class, 'payment_id', 'payment_id');
    }

    public function paymentMethod(): BelongsTo {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'payment_method_id');
    }
}

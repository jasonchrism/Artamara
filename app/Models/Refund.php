<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refund extends Model
{
    use HasFactory;

    protected $guarded = [
        'order_id',
    ];

    protected $table = "refunds";
    protected $primaryKey = 'order_id';
    protected $keyType = 'string';
    public $timestamps = true;

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}

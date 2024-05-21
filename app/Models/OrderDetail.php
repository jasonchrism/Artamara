<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;

class OrderDetail extends Model
{
    use HasFactory;

    use HasCompositeKey;

    protected $primaryKey = ['order_id', 'product_id'];
    protected $fillable = [
    'quantity',
    'product_id',
    'user_id',
    ];

    protected $table = "order_details";

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}

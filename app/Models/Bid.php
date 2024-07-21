<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Bid extends Model
{
    use HasFactory;

    use HasCompositeKey;

    protected $primaryKey = ['bid_price', 'product_id'];
    protected $fillable = [
    'bid_price',
    'user_id',
    'product_id',
    'start_date',
    'end_date',
    'add_price',
    'status',
    ];

    protected $table = "bids";
    public $timestamps = true;

    public function productAuction(): BelongsTo {
        return $this->belongsTo(ProductAuction::class, 'product_id', 'product_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}

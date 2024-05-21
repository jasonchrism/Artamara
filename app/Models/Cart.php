<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Cart extends Model
{
    use HasFactory;

    use HasCompositeKey;

    protected $primaryKey = ['user_id', 'product_id'];
    protected $fillable = [
    'quantity',
    'product_id',
    'user_id',
    ];

    protected $table = "carts";
    public $timestamps = true;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}

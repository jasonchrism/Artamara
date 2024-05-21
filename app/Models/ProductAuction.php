<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductAuction extends Model
{
    use HasFactory;

    protected $guarded = [
        'product_id',
    ];

    protected $table = "product_actions";
    protected $primaryKey = 'product_id';
    protected $keyType = 'string';
    public $timestamps = true;

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function bid(): HasMany {
        return $this->hasMany(Bid::class, 'product_id', 'product_id');
    }
}

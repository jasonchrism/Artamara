<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'product_id'
    ];

    protected $casts = [
        'photo' => 'array'
    ];

    // mendapatkan foto pertama untuk thumbnail
    public function getThumbnailAttribute()
    {
        if ($this->photo) {
            return Storage::url(json_decode($this->photo)[0]);
        }

        return 'https://via.placeholder.com/800x600';
    }

    protected $table = "products";
    protected $primaryKey = 'product_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    public function productAuctoin(): HasOne {
        return $this->hasOne(ProductAuction::class, 'product_id', 'product_id');
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function cart(): HasMany {
        return $this->hasMany(Cart::class, 'product_id', 'product_id');
    }

    public function orderDetail(): HasMany {
        return $this->hasMany(OrderDetail::class, 'product_id', 'product_id');
    }
}

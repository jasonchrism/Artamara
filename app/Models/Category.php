<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [
        'category_id'
    ];

    protected $table = "categories";
    protected $primaryKey = 'category_id';
    protected $keyType = 'integer';
    public $incrementing = true;

    public function product(): HasMany {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'rating',
        'comment',
    ];

    protected $table = "reviews";
    protected $primaryKey = 'order_id';
    protected $keyType = 'string';
    public $timestamps = true;

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}

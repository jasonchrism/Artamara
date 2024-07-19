<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Review extends Model
{
    use HasFactory;

    use HasCompositeKey;

    public function getIncrementing()
    {
        return false; // or $this->getUuidsIncrementing();
    }
    public function getCompositeKey()
    {
        return ['order_id', 'artist_id']; // Adjust according to your composite key columns
    }

    protected $fillable = [
        'order_id',
        'rating',
        'comment',
        'artist_id'
    ];

    protected $table = "reviews";
    protected $primaryKey = ['order_id', 'artist_id'];
    protected $keyType = 'string';
    public $timestamps = true;

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'artist_id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'description',
        'response',
        'path_file',
        'status',
        'failure_type',
        'receipt_number'
    ];

    protected $casts = [
        'path_file' => 'array'
    ];

    public function getPhotoAttribute()
    {
        if ($this->path_file) {
            return Storage::url(json_decode($this->path_file, true)[0]);
        }

        return 'https://via.placeholder.com/800x600';
    }

    public function getVideoAttribute()
    {
        if ($this->path_file) {
            return Storage::url(json_decode($this->path_file, true)[1]);
        }

        return 'https://via.placeholder.com/800x600';
    }

    protected $table = "refunds";
    protected $primaryKey = 'order_id';
    protected $keyType = 'string';
    public $timestamps = true;

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}

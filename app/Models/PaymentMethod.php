<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = [
        'payment_method_id',
    ];

    protected $table = "payment_methods";
    protected $primaryKey = 'payment_method_id';
    protected $keyType = 'integer';
    public $incrementing = true;

    public function payment(): HasMany {
        return $this->hasMany(Payment::class, 'payment_method_id', 'payment_method_id');
    }
}

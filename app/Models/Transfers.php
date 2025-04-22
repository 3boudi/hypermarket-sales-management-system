<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transfers extends Model
{
    protected $table='transfers';
    protected $fillable=[
        'product_id',
        'from_supermarket',
        'to_supermarket',
        'quantity',
        'status'
    ];

    public function product():BelongsTo{
        return $this->belongsTo(product::class,'product_id');
    }
    public function supermaket():BelongsTo{
        return $this->belongsTo(supermarket::class,'from_supermarket');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class stock extends Model
{
    protected $table = 'stocks';

    protected $fillable = [
        'supermarket_id',
        'product_id',
        'quantity',
    ];

    public function supermarket(): BelongsTo
    {
        return $this->belongsTo(supermarket::class, 'supermarket_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class, 'product_id');
    }
}

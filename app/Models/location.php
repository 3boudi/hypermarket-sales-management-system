<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class location extends Model
{
    protected $table = 'locations';
    protected $fillable = [
        'supermarket_id',
        'street_name',
        'state',
        'latitude',
        'longitude'
    ];

    public function supermarket(): BelongsTo
    {
        return $this->belongsTo(supermarket::class, 'supermarket_id');
    }
}

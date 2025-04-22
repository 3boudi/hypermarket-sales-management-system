<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'barcode',
        'price',
        'category_id',
        'supplier_id',
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(categorie::class, 'category_id');
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(supplier::class, 'supplier_id');
    }

    public function supermarket(): BelongsToMany
    {
        return $this->belongsToMany(supermarket::class, 'stocks', 'product_id', 'supermarket_id')->withPivot('quantity');
    }

    public function stock(): HasMany
    {
        return $this->hasMany(stock::class, 'product_id');
    }
}

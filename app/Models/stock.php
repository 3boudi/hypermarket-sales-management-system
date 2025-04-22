<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $supermarket_id
 * @property int $product_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\product $product
 * @property-read \App\Models\supermarket $supermarket
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock whereSupermarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|stock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

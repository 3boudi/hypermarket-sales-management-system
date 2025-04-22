<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $product_id
 * @property int $from_supermarket
 * @property int $to_supermarket
 * @property int $quantity
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\product $product
 * @property-read \App\Models\supermarket $supermaket
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers whereFromSupermarket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers whereToSupermarket($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transfers whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

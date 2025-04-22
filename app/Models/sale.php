<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 
 *
 * @property int $id
 * @property int $cash_register_id
 * @property string $payment_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\cashRegister $cashRegister
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|sale query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|sale whereCashRegisterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|sale wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|sale whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'payment_method',
    ];

    public function cashRegister(): BelongsTo
    {
        return $this->belongsTo(cashRegister::class, 'cash_register_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(product::class, 'sale_items', 'sale_id', 'product_id')->withPivot('quantity');
    } 
    public function cashierAtTimeOfSale()
    {
    if (!$this->cashRegister) {
        return null; 
    }

    return $this->cashRegister
        ->users()
        ->wherePivot('start_at', '<=', $this->created_at)
        ->where(function ($query) {
            $query->wherePivot('end_at', '>=', $this->created_at)
                  ->orWhereNull('end_at');
        })
        ->first();
    }


}

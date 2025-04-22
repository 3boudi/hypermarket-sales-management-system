<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $barcode
 * @property string $price
 * @property int $category_id
 * @property int $supplier_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\categorie $categorie
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\stock> $stock
 * @property-read int|null $stock_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\supermarket> $supermarket
 * @property-read int|null $supermarket_count
 * @property-read \App\Models\supplier $supplier
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

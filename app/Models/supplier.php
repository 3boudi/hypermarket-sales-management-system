<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|supplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|supplier wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|supplier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'phone_number',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(product::class, 'supplier_id');
    }
}

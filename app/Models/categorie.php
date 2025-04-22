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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|categorie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|categorie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|categorie query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|categorie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|categorie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|categorie whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|categorie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategorieFactory> */
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(product::class, 'category_id');
    }
}

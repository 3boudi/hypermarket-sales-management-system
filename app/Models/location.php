<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $supermarket_id
 * @property string $street_name
 * @property string $state
 * @property float $latitude
 * @property float $longitude
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\supermarket $supermarket
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location whereStreetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location whereSupermarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|location whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

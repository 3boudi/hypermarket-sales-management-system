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
 * @property int $supermarket_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\sale> $sales
 * @property-read int|null $sales_count
 * @property-read \App\Models\supermarket $supermarket
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|cashRegister newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|cashRegister newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|cashRegister query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|cashRegister whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|cashRegister whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|cashRegister whereSupermarketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|cashRegister whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class cashRegister extends Model
{
    /** @use HasFactory<\Database\Factories\CashRegisterFactory> */
    use HasFactory;

    protected $table = 'cash_registers';

    protected $fillable = [
        'supermarket_id',
    ];



    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shifts', 'cash_register_id', 'user_id')->withPivot('start_at', 'end_at');
    }

    public function supermarket(): BelongsTo
    {
        return $this->belongsTo(supermarket::class, 'supermarket_id');
    }
    public function sales(): HasMany
    {
        return $this->hasMany(sale::class, 'cash_register_id');
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

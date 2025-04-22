<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class supermarket extends Model
{
    /** @use HasFactory<\Database\Factories\SupermarketFactory> */
    use HasFactory;

    protected $table = 'supermarkets';
    protected $fillable = [
        'name',
        'manager_id'
    ];

    public function cashRegister(): HasMany
    {
        return $this->hasMany(cashRegister::class, 'supermarket_id');
    }

    public function location(): HasOne
    {
        return $this->hasOne(location::class, 'supermarket_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(product::class, 'stocks', 'supermarket_id', 'product_id')->withPivot('quantity');
    }
    public function manager():BelongsTo{
        
        return $this->belongsTo(User::class,'manager_id');
    }
}

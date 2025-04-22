<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

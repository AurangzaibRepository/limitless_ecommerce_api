<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->select(['id', 'name']);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(ProductRating::class);
    }
}

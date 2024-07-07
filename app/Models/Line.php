<?php

namespace App\Models;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Line extends Model
{
    use LiveAware;

    /**
     * @var string[]
     *
     * @psalm-var list{'brand'}
     */
    protected $with = [
        'brand',
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @psalm-return 'slug'
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

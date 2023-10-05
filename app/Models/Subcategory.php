<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subcategory extends Model
{
    /**
     * @var false
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return string
     *
     * @psalm-return 'slug'
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_subcategory', 'subcategory_id', 'product_id');
    }

    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }
}

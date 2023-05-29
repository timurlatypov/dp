<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
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
		return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
	}

	public function subcategories(): HasMany
	{
		return $this->hasMany(Subcategory::class,'category_id');
	}
}

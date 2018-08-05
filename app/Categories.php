<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	protected $guarded = [];

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
	}

	public function subcategories()
	{
		return $this->hasMany(Subcategory::class,'category_id');
	}
}

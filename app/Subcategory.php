<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
	public $timestamps = false;

	protected $guarded = [];

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_subcategory', 'subcategory_id', 'product_id');
	}

	public function category()
	{
		return $this->hasOne(Categories::class);
	}
}

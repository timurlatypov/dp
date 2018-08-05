<?php

namespace App;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
	use LiveAware;

	protected $guarded = [];

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}

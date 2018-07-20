<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
	public function brand()
	{
		return $this->belongsTo(Brand::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}

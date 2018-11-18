<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;

class DateFilter
{
	public function filter(Builder $builder, $value)
	{
		return $builder->whereDate('created_at', '=', $value);
	}
}
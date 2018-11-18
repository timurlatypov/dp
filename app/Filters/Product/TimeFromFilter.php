<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;

class TimeFromFilter
{
	public function filter(Builder $builder, $value)
	{
		return $builder->whereTime('updated_at', '>=', $value);
	}
}
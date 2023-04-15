<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;

class TimeToFilter
{
	public function filter(Builder $builder, $value): Builder
	{
		return $builder->whereTime('updated_at', '<=', $value);
	}
}
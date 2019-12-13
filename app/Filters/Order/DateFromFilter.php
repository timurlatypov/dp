<?php

namespace App\Filters\Order;

use Illuminate\Database\Eloquent\Builder;

class DateFromFilter
{
	public function filter(Builder $builder, $value)
	{
		return $builder->where('updated_at', '>=', $value);
	}
}
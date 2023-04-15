<?php

namespace App\Filters\Order;

use Illuminate\Database\Eloquent\Builder;

class DateToFilter
{
	public function filter(Builder $builder, $value): Builder
	{
		return $builder->whereDate('updated_at', '<=', $value);
	}
}
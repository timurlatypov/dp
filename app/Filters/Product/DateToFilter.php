<?php

namespace App\Filters\Investor;

use Illuminate\Database\Eloquent\Builder;

class DateToFilter
{
	public function filter(Builder $builder, $value)
	{
		return $builder->whereDate('updated_at', '<=', $value);
	}
}
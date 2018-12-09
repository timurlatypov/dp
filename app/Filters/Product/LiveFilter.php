<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;

class LiveFilter
{
	public function filter(Builder $builder, $value)
	{
		$value = ( $value === 'false' ? 0 : 1 );

		return $builder->where('live', $value);
	}
}
<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;

class StockFilter
{
	public function filter(Builder $builder, $value)
	{

		$value = ( $value === 'out' ? 0 : 1 );

		return $builder->where('stock', $value);
	}
}
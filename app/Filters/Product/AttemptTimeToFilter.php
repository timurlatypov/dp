<?php

namespace App\Filters\Investor;

use Illuminate\Database\Eloquent\Builder;

class attemptTimeToFilter
{
	public function filter(Builder $builder, $value)
	{
		return $builder->whereHas('login_attempts', function (Builder $builder) use ($value) {
			$builder->whereTime('updated_at', '<=', $value);
		});
	}
}
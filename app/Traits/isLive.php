<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait isLive
{
	public function scopeLive(Builder $builder): Builder
	{
		return $builder->where('live', true);
	}

	public function isLive(): bool
	{
		return $this->live === 1;
	}

	public function isNotLive(): bool
	{
		return !$this->isLive();
	}
}

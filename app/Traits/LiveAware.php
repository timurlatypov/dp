<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait LiveAware
{
    public function scopeLive(Builder $query): Builder
    {
        return $query->where('live', true);
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

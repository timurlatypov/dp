<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait LiveAware
{
    public function scopeLive(Builder $query): \Illuminate\Database\Eloquent\Builder
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

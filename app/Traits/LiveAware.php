<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait LiveAware
{
    public function scopeLive(Builder $query)
    {
        return $query->where('live', true);
    }

    public function isLive()
    {
        return $this->live === 1;
    }

    public function isNotLive()
    {
        return !$this->isLive();
    }
}

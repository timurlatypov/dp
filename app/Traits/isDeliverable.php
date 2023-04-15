<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait isDeliverable
{
    public function scopeDeliverable(Builder $builder): Builder
    {
        return $builder->where('deliverable', true);
    }

    public function isDeliverable(): bool
    {
        return $this->deliverable === 1;
    }

    public function isNotDeliverable(): bool
    {
        return !$this->isDeliverable();
    }
}

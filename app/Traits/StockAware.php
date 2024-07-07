<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait StockAware
{
    public function scopeStock(Builder $query): Builder
    {
        return $query->where('stock', true);
    }

    public function onStock(): bool
    {
        return $this->stock === 1;
    }

    public function notOnStock(): bool
    {
        return !$this->onStock();
    }
}

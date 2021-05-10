<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait StockAware
{
    public function scopeStock(Builder $query)
    {
        return $query->where('stock', true);
    }

    public function onStock()
    {
        return $this->stock === 1;
    }

    public function notOnStock()
    {
        return !$this->onStock();
    }
}

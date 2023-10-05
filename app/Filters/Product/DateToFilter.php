<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;

class DateToFilter
{
    public function filter(Builder $builder, $value): Builder
    {
        return $builder->whereDate('updated_at', '<=', $value);
    }
}

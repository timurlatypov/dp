<?php

namespace App\Filters\Order;

use Illuminate\Database\Eloquent\Builder;

class SurnameFilter
{
    public function filter(Builder $builder, $value): Builder
    {
        return $builder->where('billing_surname', $value);
    }
}

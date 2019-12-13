<?php

namespace App\Filters\Order;

use Illuminate\Database\Eloquent\Builder;

class SurnameFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder->where('billing_surname', $value);
    }
}
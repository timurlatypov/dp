<?php

namespace App\Filters\Order;

use Illuminate\Database\Eloquent\Builder;

class PhoneFilter
{
    public function filter(Builder $builder, $value): Builder
    {
        return $builder->orWhere('billing_phone', 'LIKE', "%{$value}%");
    }
}

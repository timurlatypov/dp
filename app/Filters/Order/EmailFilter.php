<?php

namespace App\Filters\Order;

use Illuminate\Database\Eloquent\Builder;

class EmailFilter
{
    public function filter(Builder $builder, $value): Builder
    {
        return $builder->orWhere('billing_email', 'LIKE', "%{$value}%");
    }
}

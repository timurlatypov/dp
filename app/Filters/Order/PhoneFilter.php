<?php

namespace App\Filters\Order;

use Illuminate\Database\Eloquent\Builder;

class PhoneFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder->whereLike('billing_phone', $value);
    }
}

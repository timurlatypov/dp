<?php

namespace App\Filters\Order;

use Illuminate\Database\Eloquent\Builder;

class EmailFilter
{
    public function filter(Builder $builder, $value)
    {
        return $builder->whereLike('billing_email', $value);
    }
}

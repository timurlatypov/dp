<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;

class BrandFilter
{
    public function filter(Builder $builder, $value): Builder
    {
        return $builder->whereHas('brand', function (Builder $builder) use ($value) {
            $builder->where('brand_id', '=', $value);
        });
    }
}

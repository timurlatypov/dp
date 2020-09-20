<?php

namespace App\Nova\Filters;

use App\Brand as BrandModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class Brand extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public function name(): string
    {
        return __('nova/resources.filters.brand.title');
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Request $request
     * @param Builder $query
     * @param mixed   $value
     *
     * @return Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('brand_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param Request $request
     *
     * @return array
     */
    public function options(Request $request)
    {
        return BrandModel::select('id', 'name')
            ->get()
            ->pluck('id', 'name')
            ->toArray();
    }
}

<?php

namespace App\Nova\Filters;

use App\Models\Brand as BrandModel;
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

    /**
     * @return array|string|null
     */
    public function name()
    {
        return __('nova/resources.filters.brand.title');
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Builder $query
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

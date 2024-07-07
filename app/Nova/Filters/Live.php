<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class Live extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * The filter's name
     *
     * @return array|string|null
     */
    public function name()
    {
        return __('nova/resources.filters.live.title');
    }

    /**
     * Apply the filter to the given query.
     *
     * @param Builder $query
     */
    public function apply(Request $request, $query, $value): Builder
    {
        return $query->where('live', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @return int[]
     *
     * @psalm-return array<0|1>
     */
    public function options(Request $request)
    {
        return [
            __('nova/resources.filters.live.options.yes') => 1,
            __('nova/resources.filters.live.options.no') => 0,
        ];
    }
}

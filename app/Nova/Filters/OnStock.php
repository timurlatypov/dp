<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class OnStock extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public $currentValue = true;

    /**
     * The filter's name
     *
     * @return string
     */
    public function name(): string
    {
        return __('nova/resources.filters.stock.title');
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
    public function apply(Request $request, $query, $value): Builder
    {
        if ($value === null) {
            return $query;
        }

        return $query->where('stock', $value);
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
        return [
            'Да'  => 1,
            'Нет' => 0,
        ];
    }
}

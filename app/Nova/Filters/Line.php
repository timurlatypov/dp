<?php

namespace App\Nova\Filters;

use App\Models\Line as LineModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class Line extends Filter
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
        return __('nova/resources.filters.line.title');
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
        return $query->where('line_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options(Request $request)
    {
        return LineModel::select('id', 'name')
            ->get()
            ->pluck('id', 'name')
            ->toArray();
    }
}

<?php

namespace App\Nova\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Spatie\Permission\Models\Permission;

class Group extends Filter
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
        return __('nova/resources.filters.group.title');
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
        return $query->where('group', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options(Request $request)
    {
        return Permission::select('id', 'group')
            ->get()
            ->pluck('group', 'group')
            ->toArray();
    }
}

<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FiltersAbstract
{
    protected Request $request;
    protected array $filters = [];

    /**
     * FiltersAbstract constructor.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Builder
     */
    public function filter(Builder $builder)
    {
        foreach ($this->getFilters() as $filter => $class) {
            $this->resolveFilter($filter)->filter($builder, $class);
        }

        return $builder;
    }

    /**
     * @return $this
     */
    public function add(array $filters)
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }

    /**
     * @return array
     */
    protected function getFilters()
    {
        return $this->filterFilters($this->filters);
    }

    /**
     * @param (int|string) $filter
     *
     * @psalm-param array-key $filter
     */
    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter]();
    }

    protected function filterFilters($filters): array
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }
}

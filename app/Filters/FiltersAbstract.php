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
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     *
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
     * @param array $filters
     *
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
     * @return mixed
     *
     * @psalm-param array-key $filter
     */
    protected function resolveFilter($filter)
    {
        return new $this->filters[$filter]();
    }

    /**
     * @param $filters
     *
     * @return array
     *
     */
    protected function filterFilters($filters): array
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }
}

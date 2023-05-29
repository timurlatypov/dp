<?php

namespace App\Filters\Product;

use App\Filters\FiltersAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilters extends FiltersAbstract
{
	/**
	 * @var array
	 */
	protected array $filters = [];
}
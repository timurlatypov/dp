<?php

namespace App\Filters\Product;

use App\Filters\FiltersAbstract;
use App\Filters\Investor\DateFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilters extends FiltersAbstract
{
	protected $filters = [];
}
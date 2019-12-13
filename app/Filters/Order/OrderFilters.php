<?php

namespace App\Filters\Order;

use App\Filters\FiltersAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderFilters extends FiltersAbstract
{
    protected $filters = [];
}
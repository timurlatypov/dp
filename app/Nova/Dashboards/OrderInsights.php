<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\NewOrders;
use Laravel\Nova\Dashboard;

class OrderInsights extends Dashboard
{


    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     *
     * @psalm-return 'order-insights'
     */
    public static function uriKey()
    {
        return 'order-insights';
    }
}

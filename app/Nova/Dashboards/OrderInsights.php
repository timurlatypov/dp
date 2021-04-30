<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\NewOrders;
use Laravel\Nova\Dashboard;

class OrderInsights extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new NewOrders()
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'order-insights';
    }
}

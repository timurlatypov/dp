<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Metrics\Value;

class NewOrders extends Value
{
    /**
     * Get the ranges available for the metric.
     *
     * @return (array|null|string)[]
     *
     * @psalm-return array{30: array|null|string, 60: array|null|string, 365: array|null|string, TODAY: array|null|string, MTD: array|null|string, QTD: array|null|string, YTD: array|null|string}
     */
    public function ranges()
    {
        return [
            30 => __('30 Дней'),
            60 => __('60 Дней'),
            365 => __('365 Дней'),
            'TODAY' => __('Сегодня'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor(): \DateInterval|\DateTimeInterface|float|int
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     *
     * @psalm-return 'new-orders'
     */
    public function uriKey()
    {
        return 'new-orders';
    }

    /**
     * Get the displayable name of the metric
     *
     * @return string
     *
     * @psalm-return 'Orders Created'
     */
    public function name()
    {
        return 'Orders Created';
    }
}

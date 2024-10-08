<?php

namespace App\Nova;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use NovaAjaxSelect\AjaxSelect;

class Coupon extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Coupon::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'coupon',
    ];

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('nova/resources.coupon.label');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('nova/resources.coupon.singularLabel');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return (bool|Date|ID|mixed|Number|Select|Text)[]
     *
     * @psalm-return list{ID, Select, Text, mixed, Text, Number, Date, Boolean, Boolean}
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Select::make(__('nova/resources.coupon.fields.level'), 'level')
                ->options([
                    'all' => 'all',
                    'brand' => 'brand',
                    'line' => 'line',
                    'product' => 'product',
                ]),

            Text::make(__('nova/resources.coupon.fields.entity_id'), 'entity_id')
                ->exceptOnForms(),

            AjaxSelect::make(__('nova/resources.coupon.fields.entity_id'), 'entity_id')
                ->get('/api/v1/{level}/options')
                ->parent('level'),

            Text::make(__('nova/resources.coupon.fields.coupon'), 'coupon')
                ->rules(['required', 'max:191']),

            Number::make(__('nova/resources.coupon.fields.discount'), 'discount')
                ->sortable()
                ->min(1)->max(99)->step(1),

            Date::make(__('nova/resources.coupon.fields.expired_at'), 'expired_at')
                ->sortable([true])
                ->firstDayOfWeek(Carbon::MONDAY),

            Boolean::make(__('nova/resources.coupon.fields.reusable'), 'reusable')
                ->withMeta(['value' => $this->reusable ?? true]),

            Boolean::make(__('nova/resources.coupon.fields.used'), 'used')
                ->hideWhenCreating(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     *
     * @psalm-return array<never, never>
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     *
     * @psalm-return array<never, never>
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     *
     * @psalm-return array<never, never>
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     *
     * @psalm-return array<never, never>
     */
    public function actions(Request $request)
    {
        return [];
    }
}

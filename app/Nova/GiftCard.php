<?php

namespace App\Nova;

use App\Models\GiftCard as GiftCardModel;
use Carbon\Carbon;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class GiftCard extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = GiftCardModel::class;

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
        'serial',
        'code',
    ];

    public static function label(): string
    {
        return __('nova/resources.gift_card.label');
    }

    public static function singularLabel(): string
    {
        return __('nova/resources.gift_card.singularLabel');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('nova/resources.gift_card.fields.serial'), 'serial')
                ->rules(['required']),

            Number::make(__('nova/resources.gift_card.fields.code'), 'code')
                ->rules(['required'])
                ->sortable(),

            Number::make(__('nova/resources.gift_card.fields.amount'), 'amount')
                ->rules(['required'])
                ->sortable(),

            Date::make(__('nova/resources.gift_card.fields.expired_at'), 'expired_at')
                ->sortable()
                ->firstDayOfWeek(Carbon::MONDAY),

            Boolean::make(__('nova/resources.gift_card.fields.used'), 'used')
                ->readonly(true),

            Number::make(__('nova/resources.gift_card.fields.user_id'), 'user_id')
                ->showOnIndex(false)
                ->readonly(true),

            Number::make(__('nova/resources.gift_card.fields.order_id'), 'order_id')
                ->showOnIndex(false)
                ->readonly(true),
        ];


    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}

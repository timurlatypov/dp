<?php

namespace App\Nova;

use App\Models\Promotion as PromotionModel;
use Carbon\Carbon;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Promotion extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = PromotionModel::class;

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
        'name',
    ];

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('nova/resources.promotion.label');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('nova/resources.promotion.singularLabel');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return (Date|ID|Image|mixed|Number|Text)[]
     *
     * @psalm-return list{ID, Text, Text, Image, Number, mixed, Date, Date}
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('nova/resources.promotion.fields.name'), 'name'),

            Text::make(__('nova/resources.promotion.fields.link'), 'link')
                ->hideFromIndex(),

            Boolean::make(__('nova/resources.promotion.fields.webp_image_path'), 'webp_image_path')
                ->resolveUsing(function ($value, $resource) {
                    return !is_null($resource->webp_image_path);
                })
                ->onlyOnIndex(),

            Image::make(__('nova/resources.promotion.fields.image_path'), 'image_path')
                ->disk('public')
                ->path('promotions')
                ->maxWidth(150)
                ->prunable(),

            Number::make(__('nova/resources.promotion.fields.sort_order'), 'sort_order')
                ->sortable(),

            Toggle::make(__('nova/resources.promotion.fields.live'), 'live')
                ->sortable()
                ->editableIndex()
                ->trueValue(1)
                ->falseValue(0),

            Date::make(__('nova/resources.promotion.fields.published_at'), 'published_at')
                ->sortable()
                ->firstDayOfWeek(Carbon::MONDAY),

            Date::make(__('nova/resources.promotion.fields.expired_at'), 'expired_at')
                ->sortable()
                ->firstDayOfWeek(Carbon::MONDAY),
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

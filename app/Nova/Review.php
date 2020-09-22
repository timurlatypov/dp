<?php

namespace App\Nova;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Textarea;
use Nikaia\Rating\Rating;

class Review extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Review::class;

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
    ];

    public static function label(): string
    {
        return __('nova/resources.review.label');
    }

    public static function singularLabel(): string
    {
        return __('nova/resources.review.singularLabel');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make(__('nova/resources.product.label'), 'product', Product::class)
                ->searchable(),

            BelongsTo::make(__('nova/resources.user.label'), 'user', User::class)
                ->searchable(),

            Textarea::make(__('nova/resources.review.fields.review'), 'review')
                ->rows(5)
                ->hideFromIndex(),

            Rating::make(__('nova/resources.review.fields.stars'), 'stars')
                ->min(0)
                ->max(5)
                ->increment(1)
                ->withStyles([
                    'star-size' => 15,
                    'rounded-corners' => true,
                ])
                ->sortable(),

            Date::make(__('nova/resources.review.fields.published_at'), 'published_at')
                ->sortable([true])
                ->firstDayOfWeek(Carbon::MONDAY),

            Boolean::make(__('nova/resources.review.fields.published'), 'published'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}

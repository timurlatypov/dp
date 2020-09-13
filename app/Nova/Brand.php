<?php

namespace App\Nova;

use App\Nova\Filters\Live;
use App\Nova\Filters\OnStock;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Brand extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Brand::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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
        return __('nova/resources.brand.label');
    }

    public static function singularLabel(): string
    {
        return __('nova/resources.brand.singularLabel');
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

            Text::make(__('nova/resources.brand.fields.name'), 'name'),

            Text::make(__('nova/resources.brand.fields.slug'), 'slug'),

            Text::make(__('nova/resources.brand.fields.title'), 'title')
                ->hideFromIndex(),

            Trix::make(__('nova/resources.brand.fields.description'), 'description')
                ->hideFromIndex(),

            Boolean::make(__('nova/resources.product.fields.live'), 'live'),

            Boolean::make(__('nova/resources.product.fields.live'), 'live'),

            HasMany::make(__('nova/resources.line.label'), 'lines', Line::class),

            HasMany::make(__('nova/resources.product.label'), 'products', Product::class),

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
        return [
            new Live,
        ];
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

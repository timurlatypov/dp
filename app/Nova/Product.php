<?php

namespace App\Nova;

use App\Nova\Brand as BrandModel;
use App\Nova\Filters\Brand;
use App\Nova\Filters\Live;
use App\Nova\Filters\OnStock;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class Product extends Resource
{
    public static $perPageViaRelationship = 15;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title_eng';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title_eng',
        'title_rus',
    ];

    public static function label(): string
    {
        return __('nova/resources.product.label');
    }

    public static function singularLabel(): string
    {
        return __('nova/resources.product.singularLabel');
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

            Text::make(__('nova/resources.product.fields.title_eng'), 'title_eng')
                ->rules('max:255'),

            BelongsTo::make(__('nova/resources.brand.fields.name'), 'brand', BrandModel::class),


            Number::make(__('nova/resources.product.fields.price'), 'price')
                ->sortable()
                ->min(1)->step(0.01),

            Number::make(__('nova/resources.product.fields.discount'), 'discount')
                ->sortable()
                ->min(1)->max(99)->step(1),

            Boolean::make(__('nova/resources.product.fields.live'), 'live'),

            Boolean::make(__('nova/resources.product.fields.stock'), 'stock'),

            HasMany::make(__('nova/resources.review.label'), 'reviews', Review::class),
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
            new Brand(),
            new OnStock(),
            new Live(),
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

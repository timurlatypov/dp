<?php

namespace App\Nova;

use App\Nova\Brand as BrandModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;

class Line extends Resource
{
    public static $perPageViaRelationship = 15;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Line::class;

    public static $group = 'Настройки';

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

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('nova/resources.line.label');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('nova/resources.line.singularLabel');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return (BelongsTo|ID|Text)[]
     *
     * @psalm-return list{ID, Text, BelongsTo, Text}
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('nova/resources.line.fields.name'), 'name'),

            BelongsTo::make(__('nova/resources.brand.fields.name'), 'brand', BrandModel::class),

            Text::make(__('nova/resources.line.fields.slug'), 'slug'),
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
     * @psalm-return array<never, never>
     */
    public function lenses(Request $request): array
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

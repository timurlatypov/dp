<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

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
        'name',
    ];

    /**
     * @return array|null|string
     */
    public static function label()
    {
        return __('nova/resources.categories.label');
    }

    /**
     * @return array|null|string
     */
    public static function singularLabel()
    {
        return __('nova/resources.categories.singularLabel');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param Request $request
     *
     * @return (ID|Text)[]
     *
     * @psalm-return list{ID, Text}
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('nova/resources.categories.fields.name'), 'name')
                ->rules(['required', 'max:191']),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param Request $request
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
     * @param Request $request
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
     * @param Request $request
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
     * @param Request $request
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
<?php

namespace App\Nova;

use App\Models\Menu as MenuModel;
use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;

class Menu extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = MenuModel::class;

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
     * Get the fields displayed by the resource.
     *
     * @return (BelongsTo|HasMany|ID|Slug|TextWithSlug)[]
     *
     * @psalm-return list{ID, TextWithSlug, Slug, BelongsTo, HasMany}
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            TextWithSlug::make('Name', 'name')
                ->sortable()
                ->rules(['required', 'max:191'])
                ->slug('slug'),

            Slug::make('Slug', 'slug')
                ->disableAutoUpdateWhenUpdating()
                ->hideFromIndex()
                ->help(__('nova/resources.product.hint.slug'))
                ->rules(['required', 'max:191'])
                ->creationRules(
                    'unique:menus,slug,NULL'
                )
                ->updateRules(
                    "unique:menus,slug,{$this->id}"
                ),
            BelongsTo::make('Parent', 'parent', Menu::class)
                ->nullable(true),

            HasMany::make('Children', 'children', Menu::class),
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

<?php

namespace App\Nova;

use App\Nova\Categories;
use App\Nova\Filters\Brand;
use App\Nova\Filters\Line;
use App\Nova\Filters\Live;
use App\Nova\Filters\OnStock;
use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Saumini\Count\RelationshipCount;

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
        'vendor_code',
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        // Give relationship name as alias else Laravel will name it as comments_count
        return $query->withCount('reviews as reviews');
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

            TextWithSlug::make(__('nova/resources.product.fields.title_eng'), 'title_eng')
                ->rules(['required', 'max:191'])
                ->slug('slug'),

            Slug::make(__('nova/resources.product.fields.slug'), 'slug')
                ->disableAutoUpdateWhenUpdating()
                ->hideFromIndex()
                ->help(__('nova/resources.product.hint.slug'))
                ->rules(['required', 'max:191'])
                ->creationRules(
                    "unique:products,slug,NULL"
                )
                ->updateRules(
                    "unique:products,slug,{$this->id}"
                ),

            Text::make(__('nova/resources.product.fields.vendor_code'), 'vendor_code')
                ->readonly(true),

            Text::make(__('nova/resources.product.fields.title_rus'), 'title_rus')
                ->hideFromIndex()
                ->rules(['required', 'max:191']),

            NovaBelongsToDepend::make('Brand')
                ->placeholder('Select Brand')
                ->options(\App\Brand::all()),
            NovaBelongsToDepend::make('Line')
                ->placeholder('Select Line')
                ->optionsResolve(function ($brand) {
                    return $brand->lines()->get(['id', 'name']);
                })
                ->dependsOn('Brand')
                ->nullable(),

            Text::make(__('nova/resources.product.fields.ph'), 'ph')
                ->hideFromIndex()
                ->rules(['max:191']),

            Text::make(__('nova/resources.product.fields.description_short'), 'description_short')
                ->hideFromIndex()
                ->rules(['max:191']),

            Trix::make(__('nova/resources.product.fields.description_full'), 'description_full')
                ->hideFromIndex(),

            Image::make(__('nova/resources.product.fields.image_path'), 'image_path')
                ->disk('public')
                ->path('products/image')
                ->preview(function () {
                    return $this->image_path ? Storage::disk('public')->url("products/image/{$this->image_path}") : null;
                })
                ->storeOriginalName('image_filename_original')
                ->prunable()
                ->help(__('nova/resources.product.hint.image_path'))
                ->hideFromIndex(),

            Avatar::make(__('nova/resources.product.fields.thumb_path'), 'thumb_path')
                ->squared()
                ->disk('public')
                ->path('products/thumb')
                ->preview(function () {
                    return $this->thumb_path ? Storage::disk('public')->url("products/thumb/{$this->thumb_path}") : null;
                })
                ->thumbnail(function () {
                    return $this->image_path ? Storage::disk('public')->url("products/image/{$this->image_path}") : null;
                })
                ->storeOriginalName('image_filename_original')
                ->help(__('nova/resources.product.hint.thumb_path'))
                ->prunable(),

            Number::make(__('nova/resources.product.fields.price'), 'price')
                ->sortable()
                ->min(1)->step(0.01),

            Number::make(__('nova/resources.product.fields.discount'), 'discount')
                ->sortable()
                ->min(1)->max(99)->step(1),

            Boolean::make(__('nova/resources.product.fields.live'), 'live'),

            Boolean::make(__('nova/resources.product.fields.stock'), 'stock'),

            RelationshipCount::make(__('nova/resources.product.fields.reviews'), 'reviews')
                ->sortable()
                ->onlyOnIndex(),

            HasMany::make(__('nova/resources.review.label'), 'reviews', Review::class),

            BelongsToMany::make(__('nova/resources.categories.label'), 'categories', Categories::class),

            BelongsToMany::make(__('nova/resources.subcategory.label'), 'subcategories', Subcategory::class),
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
            new Line(),
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

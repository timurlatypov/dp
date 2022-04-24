<?php

namespace App\Nova;

use App\Nova\Filters\Brand;
use App\Nova\Filters\Line;
use App\Nova\Filters\Live;
use App\Nova\Filters\Feed;
use App\Nova\Filters\OnStock;
use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Saumini\Count\RelationshipCount;
use Davidpiesse\NovaToggle\Toggle;

class Product extends Resource
{
    public static $defaultSortField = 'id';

    public static $perPageViaRelationship = 50;

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

            Toggle::make(__('nova/resources.product.fields.stock'), 'stock')
                ->sortable()
                ->editableIndex()
                ->trueValue(1)
                ->falseValue(0),

            TextWithSlug::make(__('nova/resources.product.fields.title_eng'), 'title_eng')
                ->sortable()
                ->rules(['required', 'max:191'])
                ->slug('slug'),

            Text::make(__('nova/resources.product.fields.title_rus'), 'title_rus')
                ->hideFromIndex()
                ->rules(['max:191']),

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

            NovaBelongsToDepend::make('Brand')
                ->sortable()
                ->placeholder('Select Brand')
                ->options(\App\Brand::all()),

            NovaBelongsToDepend::make('Line')
                ->sortable()
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
                ->maxWidth(150)
                ->preview(function () {
                    return $this->image_path ? Storage::disk('public')->url($this->image_path) : null;
                })
                ->help(__('nova/resources.product.hint.image_path'))
                ->prunable()
                ->hideFromIndex(),

            Image::make(__('nova/resources.product.fields.thumb_path'), 'thumb_path')
                ->disk('public')
                ->path('products/thumb')
                ->maxWidth(150)
                ->preview(function () {
                    return $this->thumb_path ? Storage::disk('public')->url("{$this->thumb_path}") : null;
                })
                ->thumbnail(function () {
                    return $this->thumb_path ? Storage::disk('public')->url("{$this->image_path}") : null;
                })
                ->help(__('nova/resources.product.hint.thumb_path'))
                ->prunable(),

            Number::make(__('nova/resources.product.fields.price'), 'price')
                ->sortable()
                ->min(1)->step(0.01),

            Number::make(__('nova/resources.product.fields.discount'), 'discount')
                ->sortable()
                ->min(0)->max(99)->step(1),

            Toggle::make(__('nova/resources.product.fields.live'), 'live')
                ->sortable()
                ->editableIndex()
                ->trueValue(1)
                ->falseValue(0),

            Toggle::make(__('nova/resources.product.fields.feed'), 'feed')
                ->sortable()
                ->editableIndex()
                ->trueValue(1)
                ->falseValue(0),

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
            new Feed(),
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

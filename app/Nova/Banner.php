<?php

namespace App\Nova;

use App\Models\Banner as BannerModel;
use App\Nova\Actions\Banner\ConvertBannerImageToWebp;
use Carbon\Carbon;
use Davidpiesse\NovaToggle\Toggle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;
use Timothyasp\Color\Color;

class Banner extends Resource
{
    use HasSortableRows;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = BannerModel::class;

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

    /**
     * @return array|string|null
     */
    public static function label()
    {
        return __('nova/resources.banner.label');
    }

    /**
     * @return array|string|null
     */
    public static function singularLabel()
    {
        return __('nova/resources.banner.singularLabel');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return (Color|Date|ID|Image|mixed|Number|Text)[]
     *
     * @psalm-return list{ID, Text, Text, Image, Image, Color, Number, mixed, Date, Date}
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('nova/resources.banner.fields.name'), 'name'),

            Text::make(__('nova/resources.banner.fields.link'), 'link')
                ->hideFromIndex(),

            Boolean::make(__('nova/resources.banner.fields.banner_desktop_webp'), 'banner_desktop_webp')
                ->resolveUsing(function ($value, $resource) {
                    return !is_null($resource->banner_desktop_webp);
                })
                ->onlyOnIndex(),

            Boolean::make(__('nova/resources.banner.fields.banner_mobile_webp'), 'banner_mobile_webp')
                ->resolveUsing(function ($value, $resource) {
                    return !is_null($resource->banner_mobile_webp);
                })
                ->onlyOnIndex(),

            Image::make(__('nova/resources.banner.fields.banner_desktop'), 'banner_desktop')
                ->disk('public')
                ->path('banners')
                ->maxWidth(150)
                ->preview(function () {
                    return $this->banner_desktop ? Storage::disk('public')->url($this->banner_desktop) : null;
                })
                ->prunable()
                ->hideFromIndex(),

            Image::make(__('nova/resources.banner.fields.banner_mobile'), 'banner_mobile')
                ->disk('public')
                ->path('banners')
                ->maxWidth(150)
                ->preview(function () {
                    return $this->banner_mobile ? Storage::disk('public')->url($this->banner_mobile) : null;
                })
                ->prunable(),

            Color::make(__('nova/resources.banner.fields.bg_color'), 'bg_color')
                ->rules('required'),

            Number::make(__('nova/resources.banner.fields.sort_order'), 'sort_order')
                ->sortable(),

            Toggle::make(__('nova/resources.banner.fields.live'), 'live')
                ->sortable()
                ->editableIndex()
                ->trueValue(1)
                ->falseValue(0),

            Date::make(__('nova/resources.banner.fields.published_at'), 'published_at')
                ->sortable()
                ->firstDayOfWeek(Carbon::MONDAY),

            Date::make(__('nova/resources.banner.fields.expired_at'), 'expired_at')
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
        return [
            new ConvertBannerImageToWebp(),
        ];
    }
}

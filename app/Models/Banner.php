<?php

namespace App\Models;

use App\Jobs\Banner\CreateBannerWebpImage;
use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Banner extends Model implements Sortable
{
    use SortableTrait;
    use LiveAware;
    use SoftDeletes;

    /**
     * @var string[]
     *
     * @psalm-var list{'name', 'banner_desktop', 'banner_mobile', 'bg_color', 'link', 'sort_order', 'live', 'published_at', 'expired_at'}
     */
    protected $fillable = [
        'name',
        'banner_desktop',
        'banner_mobile',
        'banner_desktop_webp',
        'banner_mobile_webp',
        'bg_color',
        'link',
        'sort_order',
        'live',
        'published_at',
        'expired_at',
    ];

    /**
     * @var string[]
     *
     * @psalm-var array{published_at: 'datetime', expired_at: 'datetime', live: 'boolean'}
     */
    protected $casts = [
        'published_at' => 'datetime',
        'expired_at' => 'datetime',
        'live' => 'boolean',
    ];

    /**
     * @var (string|true)[]
     *
     * @psalm-var array{order_column_name: 'sort_order', sort_when_creating: true}
     */
    public array $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    public function getDesktopImageUrlAttribute()
    {
        return $this->getImageUrl($this->banner_desktop_webp, $this->banner_desktop);
    }

    public function getMobileImageUrlAttribute()
    {
        return $this->getImageUrl($this->banner_mobile_webp, $this->banner_mobile);
    }

    private function getImageUrl($webpPath, $originalPath)
    {
        if ($webpPath && Storage::exists($webpPath)) {
            return Storage::url($webpPath);
        }

        return $originalPath ? Storage::url($originalPath) : null;
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saved(function ($banner) {
            if (!is_null($banner->banner_desktop) || !is_null($banner->banner_mobile)) {
                CreateBannerWebpImage::dispatch($banner);
            }
        });
    }
}

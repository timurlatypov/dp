<?php

namespace App;

use App\Contracts\Feedable;
use App\Filters\Product\ProductFilters;
use App\Models\Menu;
use App\Traits\FeedAware;
use App\Traits\LiveAware;
use App\Traits\StockAware;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model implements Feedable
{
    use SoftDeletes;
    use LiveAware;
    use StockAware;
    use Searchable;
    use FeedAware;

    protected $guarded = [];

    protected $with = [
        'brand',
    ];

    protected $appends = [
        'new_product',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function searchableAs()
    {
        return config('scout.prefix') . 'products';
    }

    public function toSearchableArray()
    {
        $properties = $this->only(['id', 'title_eng', 'title_rus', 'vendor_code', 'deleted_at', 'live', 'thumb_path','slug']);
        $properties['brand'] = $this->brand->only('name', 'slug');
        $properties['line'] = $this->line;

        return $properties;
    }

    public function definePriceToShow()
    {
        return $this->discount ? $this->discounted_price() : $this->price;
    }

    private function discounted_price()
    {
        return round($this->price * (($this->discount - 100) / -100));
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function line(): BelongsTo
    {
        return $this->belongsTo(Line::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_category', 'product_id', 'category_id');
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'product_subcategory', 'product_id', 'subcategory_id');
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'product_related', 'product_id', 'related_id');
    }

    /**
     * @return BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    /**
     *
     * SCOPES
     *
     */
    public function scopeDiscount(Builder $builder)
    {
        return $builder->where('discount', '>', '0')->orderBy('discount', 'desc');
    }

    public function scopeNovelties(Builder $builder)
    {
        return $builder->where('novelty', true);
    }

    public function scopeBestsellers(Builder $builder)
    {
        return $builder->where('bestseller', true);
    }


    /**
     *
     * ATRIBUTES
     *
     */
    public function getNewProductAttribute()
    {
        return $this->categories()->where('slug', 'new-products')->first();
    }
    /**
     *
     * FILTERS
     *
     */
    public function scopeFilter(Builder $builder, $request, array $filters = [])
    {
        return (new ProductFilters($request))->add($filters)->filter($builder);
    }

    public function getReviews()
    {
        return $this->reviews()->published()->orderBy('stars', 'asc')->get();
    }

    public function getAverageRating()
    {
        return round($this->reviews()->published()->average('stars'), 2, PHP_ROUND_HALF_UP);
    }

    public function getProperDisplay()
    {
        $number = $this->reviews()->published()->count();

        return 'Всего ' . $number . ' отзыв' . self::properEnding($number, ['.', 'а.', 'ов.']);
    }

    private static function properEnding($number, $titles)
    {
        $cases = [2, 0, 1, 1, 1, 2];

        return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title_eng . ' ' . $this->title_rus ?? '';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description_short ?? '';
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return env('APP_URL') . "/brand/" . $this->brand->slug . "/" . $this->slug;
    }

    /**
     * @return string
     */
    public function getBrandName(): string
    {
        return $this->brand->name;
    }

    /**
     * @return int
     */
    public function getVendorCode(): int
    {
        return $this->vendor_code;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return get_image_path($this->image_path);
    }

    /**
     * @return int
     */
    public function getBasePrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->menu_id;
    }

    /**
     * @return ProductFeedItem
     */
    public function toFeedItem(): ProductFeedItem
    {
        return ProductFeedItem::create()
            ->setId($this->getId())
            ->setTitle($this->getTitle())
            ->setDescription($this->getDescription())
            ->setDiscountedPrice($this->definePriceToShow())
            ->setBasePrice($this->getBasePrice())
            ->setPicture($this->getImagePath())
            ->setLink($this->getLink())
            ->setVendor($this->getBrandName())
            ->setVendorCode($this->getVendorCode())
            ->setCategoryId($this->getCategoryId());
    }

    /**
     * @return mixed
     */
    public static function getFeedProducts(): Collection
    {
        return Product::toFeed()
            ->live()
            ->stock()
            ->get();
    }
}

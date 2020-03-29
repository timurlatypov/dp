<?php

namespace App;

use App\Filters\Product\ProductFilters;
use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Product extends Model
{
	use SoftDeletes, LiveAware, Searchable;

	protected $guarded = [];

	protected $with = [
	    'brand'
    ];

	protected $appends = ['new_product'];

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function searchableAs()
	{
		return config('scout.prefix').'products';
	}

	public function toSearchableArray()
	{
		$properties = $this->toArray();
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

    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }
	public function line()
	{
		return $this->belongsTo(Line::class);
	}
	public function categories()
	{
		return $this->belongsToMany(Categories::class, 'product_category', 'product_id', 'category_id');
	}

	public function subcategories()
	{
		return $this->belongsToMany(Subcategory::class, 'product_subcategory');
	}

	public function related()
	{
		return $this->belongsToMany(Product::class, 'product_related','product_id','related_id');
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
//	public function getBrandAttribute()
//	{
//		return $this->brand()->first();
//	}
    //FIXME
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


}

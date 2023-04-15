<?php

namespace App\Models;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
	use LiveAware;

    public const EXCLUDE = [
        11,
        17
    ];

	/**
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * @return string
	 *
	 * @psalm-return 'slug'
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}

    public function products(): HasMany
    {
    	return $this->hasMany(Product::class);
    }

	public function lines(): HasMany
	{
		return $this->hasMany(Line::class);
	}
}

<?php

namespace App;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	use LiveAware;

    public const EXCLUDE = [
        11,
        17
    ];

	protected $guarded = [];

	public function getRouteKeyName()
	{
		return 'slug';
	}

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

	public function lines()
	{
		return $this->hasMany(Line::class);
	}
}

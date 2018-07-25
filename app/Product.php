<?php

namespace App;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use LiveAware;

	protected $guarded = [];

	public function getRouteKeyName(){
		return 'slug';
	}

    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }

	public function line()
	{
		return $this->belongsTo(Line::class);
	}

	public function thumb()
	{
		return asset( $this->thumb_path ? '/storage/thumbs/'.$this->thumb_path : '/storage/thumbs/default.jpg');
	}

	public function image()
	{
		return asset( $this->image_path ? '/storage/images/'.$this->image_path : '/storage/thumbs/default.jpg');
	}

}

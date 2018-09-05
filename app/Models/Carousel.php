<?php

namespace App\Models;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carousel extends Model
{
    use LiveAware, SoftDeletes;

    protected $guarded = [];

	protected $appends = ['expired_at_diff'];

	protected $dates = ['expired_at'];

	public function getExpiredAtDiffAttribute()
	{
		return $this->expired_at->format('d M Y');
	}
}

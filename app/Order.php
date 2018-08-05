<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $guarded = [];

	protected $appends = ['order_id'];

	public function getOrderIdAttribute()
	{
		return 'DP-'.str_pad($this->id,6,'0',STR_PAD_LEFT);
	}
}

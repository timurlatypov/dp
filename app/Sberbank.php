<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sberbank extends Model
{
	protected $guarded = [];

	public function order()
	{
		return $this->belongsToMany(Order::class, 'orders_payments', 'payment_id', 'order_id');
	}

}

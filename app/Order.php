<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

	protected $guarded = [];

	protected $appends = ['order_id'];



	public function getOrderCurrentStatusAttribute()
	{
		if ($this->order_status === 'Новый') {
			return '<span class="text-success">'.$this->order_status.'</span>';
		} else if ($this->order_status === 'В работе') {
			return '<span class="text-warning">'.$this->order_status.'</span>';
		} else if ($this->order_status === 'Доставлен') {
			return '<span class="text-info">'.$this->order_status.'</span>';
		} else if ($this->order_status === 'Отменен') {
			return '<span class="text-danger">'.$this->order_status.'</span>';
		} else {
			return $this->order_status;
		}
	}

	public function getOrderIdAttribute()
	{
		return 'DP-'.str_pad($this->id,6,'0',STR_PAD_LEFT);
	}

	public static function countNewOrders()
	{
		$o = Order::newOrders()->get();
		if(count($o))
		{
			return count($o);
		}
		return null;
	}

	public function scopeNewOrders(Builder $builder)
	{
		return $builder->where('order_status', 'Новый');
	}

	public function manager()
	{
		return $this->belongsTo(User::class, 'manager_id');
	}

	public function ym()
	{
		return $this->belongsToMany(YandexMetrika::class, 'orders_ym', 'order_id', 'ym');
	}

	public function ga()
	{
		return $this->belongsToMany(GoogleAnalytics::class, 'orders_ga', 'order_id', 'ga');
	}
}

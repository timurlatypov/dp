<?php

namespace App;

use App\Permissions\HasPermissionsTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;

	protected $loyalty_discount = 0;

	protected $appends = ['loyalty'];

    protected $fillable = ['name', 'surname', 'phone', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function addresses()
    {
    	return $this->hasMany(Address::class);
    }

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function favorites()
	{
		return $this->belongsToMany(Product::class, 'users_products');
	}

	public function totalSum()
	{
		return array_sum($this->orders->where('order_status', 'Доставлен')->pluck('billing_total')->toArray());
	}

	public function getLoyaltyAttribute()
	{
		return $this->discountAmount();
	}

	public function discountAmount()
	{
		$totalSum = $this->totalSum();

		if ( $totalSum > 0 && $totalSum <= 15000) {
			$this->loyalty_discount = 0;
		} elseif ( $totalSum > 15000 && $totalSum <= 30000 ) {
			$this->loyalty_discount = 5;
		} elseif ($totalSum > 30000 && $totalSum <= 60000) {
			$this->loyalty_discount = 7;
		} elseif ($totalSum > 60000) {
			$this->loyalty_discount = 10;
		}
		return $this->loyalty_discount;
	}
}

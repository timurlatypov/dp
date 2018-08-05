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

	private function totalSum()
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

		if ( $totalSum > 0 && $totalSum <= 3000) {
			$this->loyalty_discount = 0;
		} elseif ( $totalSum > 3000 && $totalSum <= 6000 ) {
			$this->loyalty_discount = 3;
		} elseif ($totalSum > 6000 && $totalSum <= 9000) {
			$this->loyalty_discount = 6;
		} elseif ($totalSum > 9000 && $totalSum <= 12000) {
			$this->loyalty_discount = 9;
		} elseif ($totalSum > 12000) {
			$this->loyalty_discount = 12;
		}
		return $this->loyalty_discount;
	}
}

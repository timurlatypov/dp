<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    protected $loyalty_discount = 0;

    protected $appends = [
        'loyalty',
    ];

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }

    public function ym()
    {
        return $this->belongsToMany(YandexMetrika::class, 'users_ym', 'user_id', 'ym');
    }

    public function ga()
    {
        return $this->belongsToMany(GoogleAnalytics::class, 'users_ym', 'user_id', 'ga');
    }

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
        return array_sum($this->orders->where('order_status', 'Доставлен')->pluck('billing_subtotal')->toArray());
    }


    public function getLoyaltyAttribute()
    {

        if (count($this->orders) === 0) {
            return $loyalty_discount = 0;
        }

        return $this->discountAmount();
    }

    public function discountAmount()
    {
        $totalSum = $this->totalSum();

        if ($totalSum >= 0 && $totalSum <= 15000) {
            $this->loyalty_discount = 0;
        } elseif ($totalSum > 15000 && $totalSum <= 30000) {
            $this->loyalty_discount = 0;
        } elseif ($totalSum > 30000 && $totalSum <= 60000) {
            $this->loyalty_discount = 0;
        } elseif ($totalSum > 60000) {
            $this->loyalty_discount = 0;
        }

        return $this->loyalty_discount;
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }

}

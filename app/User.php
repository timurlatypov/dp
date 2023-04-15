<?php

namespace App;

use App\Models\Address;
use App\Models\GoogleAnalytics;
use App\Models\Order;
use App\Models\Product;
use App\Models\YandexMetrika;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    /**
     * @var string[]
     *
     * @psalm-var list{'loyalty'}
     */
    protected $appends = [
        'loyalty',
    ];

    /**
     * @var string[]
     *
     * @psalm-var list{'name', 'surname', 'phone', 'email', 'password'}
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'password',
    ];

    /**
     * @var string[]
     *
     * @psalm-var list{'password', 'remember_token'}
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }

    public function ym(): BelongsToMany
    {
        return $this->belongsToMany(YandexMetrika::class, 'users_ym', 'user_id', 'ym');
    }

    public function ga(): BelongsToMany
    {
        return $this->belongsToMany(GoogleAnalytics::class, 'users_ym', 'user_id', 'ga');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'users_products');
    }

    /**
     * @return float|int
     */
    public function totalSum()
    {
        return array_sum($this->orders->where('order_status', 'Доставлен')->pluck('billing_subtotal')->toArray());
    }

    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }
}

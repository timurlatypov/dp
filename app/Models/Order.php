<?php

namespace App\Models;

use App\Cart\Money;
use App\Filters\Order\OrderFilters;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public const PENDING = 'Новый';
    public const PROCESSING = 'В работе';
    public const DELIVERED = 'Доставлен';
    public const CANCELLED = 'Отменён';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $appends = [
        'order_id',
        'order_id_raw'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_status = self::PENDING;
        });
    }

    public function getOrderCurrentStatusAttribute()
    {
        switch ($this->order_status) {
            case self::PENDING:
                return '<span class="text-success">'.$this->order_status.'</span>';
            case self::PROCESSING:
                return '<span class="text-warning">'.$this->order_status.'</span>';
            case self::DELIVERED:
                return '<span class="text-info">'.$this->order_status.'</span>';
            case self::CANCELLED:
                return '<span class="text-danger">'.$this->order_status.'</span>';
            default:
                return $this->order_status;
        }
    }

    public function getOrderIdAttribute(): string
    {
        return 'DP-'.str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function getOrderIdRawAttribute(): string
    {
        return $this->id;
    }

    /**
     * @return int|null
     *
     * @psalm-return int<0, max>|null
     */
    public static function countNewOrders(): ?int
    {
        $o = self::newOrders()->get();
        if (count($o)) {
            return count($o);
        }
        return null;
    }

    public function scopeNewOrders(Builder $builder): Builder
    {
        return $builder->where('order_status', 'Новый');
    }

    public function giftCard(): BelongsTo
    {
        return $this->belongsTo(GiftCard::class, 'gift_card_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function ym(): BelongsToMany
    {
        return $this->belongsToMany(YandexMetrika::class, 'orders_ym', 'order_id', 'ym');
    }

    public function ga(): BelongsToMany
    {
        return $this->belongsToMany(GoogleAnalytics::class, 'orders_ga', 'order_id', 'ga');
    }

    public function sberbankPayments(): BelongsToMany
    {
        return $this->belongsToMany(Sberbank::class, 'orders_payments', 'order_id', 'payment_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * @return mixed|null
     */
    public function getGiftCardId()
    {
        return $this->gift_card_id ?? null;
    }

    /**
     * FILTERS
     */
    public function scopeFilter(Builder $builder, $request, array $filters = []): Builder
    {
        return (new OrderFilters($request))->add($filters)->filter($builder);
    }

    public function getSubtotalAttribute($subtotal): Money
    {
        return new Money($subtotal);
    }

    public function total()
    {
        return $this->subtotal->add($this->shippingMethod->price);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sberbank extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    public function order(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_payments', 'payment_id', 'order_id');
    }

}

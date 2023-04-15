<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     *
     * @psalm-var array{expired_at: 'datetime'}
     */
    protected $casts = [
        'expired_at' => 'datetime',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    protected $casts = [
        'expired_at' => 'datetime',
    ];
}

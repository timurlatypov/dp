<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiftCard extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'serial',
        'code',
        'amount',
        'used',
        'user_id',
        'order_id',
        'expired_at',
    ];

    protected $casts = [
        'used'         => 'boolean',
        'expired_at'   => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiftCard extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string[]
     *
     * @psalm-var list{'serial', 'code', 'amount', 'used', 'user_id', 'order_id', 'expired_at'}
     */
    protected $fillable = [
        'serial',
        'code',
        'amount',
        'used',
        'user_id',
        'order_id',
        'expired_at',
    ];

    /**
     * @var string[]
     *
     * @psalm-var array{used: 'boolean', expired_at: 'datetime'}
     */
    protected $casts = [
        'used' => 'boolean',
        'expired_at' => 'datetime',
    ];
}

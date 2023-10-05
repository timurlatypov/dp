<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    /**
     * @var string[]
     *
     * @psalm-var list{'name', 'address', 'phone', 'comment', 'default'}
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'comment',
        'default'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(static function ($address) {
            if ($address->default) {
                $address->user->addresses()->update([
                    'default' => false
                ]);
            }
        });
    }

    public function setDefaultAttribute($value): void
    {
        $this->attributes['default'] = (bool)$value;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

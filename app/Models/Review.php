<?php

namespace App\Models;

use App\Traits\PublishedAware;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use PublishedAware;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'stars',
        'review',
        'published',
        'published_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'published'    => 'bool',
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

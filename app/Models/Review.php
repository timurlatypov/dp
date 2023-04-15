<?php

namespace App\Models;

use App\Traits\PublishedAware;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    use PublishedAware;

    /**
     * @var string[]
     *
     * @psalm-var list{'user_id', 'product_id', 'stars', 'review', 'published', 'published_at'}
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
     *
     * @psalm-var array{published: 'bool', published_at: 'datetime'}
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

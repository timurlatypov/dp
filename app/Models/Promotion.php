<?php

namespace App\Models;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model implements Sortable
{
    use SortableTrait;
    use LiveAware;
    use SoftDeletes;

    /**
     * @var string[]
     *
     * @psalm-var list{'name', 'image_path', 'sort_order', 'live', 'published_at', 'expired_at'}
     */
    protected $fillable = [
        'name',
        'image_path',
        'sort_order',
        'live',
        'published_at',
        'expired_at',
    ];

    /**
     * @var string[]
     *
     * @psalm-var array{published_at: 'datetime', expired_at: 'datetime', live: 'boolean'}
     */
    protected $casts = [
        'published_at' => 'datetime',
        'expired_at'   => 'datetime',
        'live'         => 'boolean',
    ];

    /**
     * @var (string|true)[]
     *
     * @psalm-var array{order_column_name: 'sort_order', sort_when_creating: true}
     */
    public array $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];
}
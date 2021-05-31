<?php

namespace App;

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

    protected $fillable = [
        'name',
        'image_path',
        'sort_order',
        'live',
        'published_at',
        'expired_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'expired_at'   => 'datetime',
        'live'         => 'boolean',
    ];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];
}

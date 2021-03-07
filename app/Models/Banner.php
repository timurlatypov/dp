<?php

namespace App\Models;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Banner extends Model implements Sortable
{
    use SortableTrait;
    use HasFactory;
    use LiveAware;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'banner_desktop',
        'banner_mobile',
        'bg_color',
        'link',
        'order_id',
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

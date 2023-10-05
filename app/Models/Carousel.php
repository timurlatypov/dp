<?php

namespace App\Models;

use App\Traits\LiveAware;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carousel extends Model
{
    use LiveAware;
    use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     *
     * @psalm-var list{'expired_at_diff'}
     */
    protected $appends = ['expired_at_diff'];

    /**
     * @var string[]
     *
     * @psalm-var list{'expired_at'}
     */
    protected $dates = ['expired_at'];

    public function scopeExpired(Builder $builder): Builder
    {
        return $builder->where('expired_at', '>', now());
    }

    public function getExpiredAtDiffAttribute()
    {
        return $this->expired_at->format('d M Y');
    }
}

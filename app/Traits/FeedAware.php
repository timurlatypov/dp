<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FeedAware
{
    public function scopeToFeed(Builder $query)
    {
        return $query->where('feed', true);
    }

    public function onFeed()
    {
        return $this->feed === 1;
    }

    public function notOnFeed()
    {
        return !$this->onFeed();
    }
}

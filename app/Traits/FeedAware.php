<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FeedAware
{
    public function scopeToFeed(Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('feed', true);
    }

    public function onFeed(): bool
    {
        return $this->feed === 1;
    }

    public function notOnFeed(): bool
    {
        return !$this->onFeed();
    }
}

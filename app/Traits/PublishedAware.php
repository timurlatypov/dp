<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PublishedAware
{
    public function scopePublished(Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('published', 1);
    }

    public function isPublished(): bool
    {
        return $this->published === 1;
    }

    public function isNotPublished(): bool
    {
        return !$this->isPublished();
    }
}

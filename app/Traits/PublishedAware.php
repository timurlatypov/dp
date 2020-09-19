<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PublishedAware
{
    public function scopePublished(Builder $query)
    {
        return $query->where('published', 1);
    }

    public function isPublished()
    {
        return $this->published === 1;
    }

    public function isNotPublished()
    {
        return !$this->isPublished();
    }
}

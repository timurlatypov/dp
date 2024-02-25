<?php

namespace App\Policies;

use App\Models\Review;
use App\User;

class ReviewPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view reviews');
    }

    public function view(User $user, Review $review): bool
    {
        return $user->can('view own reviews');
    }

    public function create(User $user): bool
    {
        return $user->can('create reviews');
    }

    public function update(User $user, Review $review): bool
    {
        return $user->can('edit reviews');
    }

    public function delete(User $user, Review $review): bool
    {
        return $user->can('delete reviews');
    }

    public function forceDelete(User $user, Review $review): bool
    {
        return $user->can('forceDelete reviews');
    }
}

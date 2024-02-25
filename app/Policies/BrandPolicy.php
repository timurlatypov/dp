<?php

namespace App\Policies;

use App\Models\Brand;
use App\User;

class BrandPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view brands');
    }

    public function view(User $user, Brand $brand): bool
    {
        return $user->can('view own brands');
    }

    public function create(User $user): bool
    {
        return $user->can('create brands');
    }

    public function update(User $user, Brand $brand): bool
    {
        return $user->can('edit brands');
    }

    public function delete(User $user, Brand $brand): bool
    {
        return $user->can('delete brands');
    }

    public function forceDelete(User $user, Brand $brand): bool
    {
        return $user->can('forceDelete brands');
    }
}

<?php

namespace App\Policies;

use App\Models\Subcategory;
use App\User;

class SubcategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view subcategories');
    }

    public function view(User $user, Subcategory $subcategory): bool
    {
        return $user->can('view own subcategories');
    }

    public function create(User $user): bool
    {
        return $user->can('create subcategories');
    }

    public function update(User $user, Subcategory $subcategory): bool
    {
        return $user->can('edit subcategories');
    }

    public function delete(User $user, Subcategory $subcategory): bool
    {
        return $user->can('delete subcategories');
    }

    public function forceDelete(User $user, Subcategory $subcategory): bool
    {
        return $user->can('forceDelete subcategories');
    }
}

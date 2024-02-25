<?php

namespace App\Policies;

use App\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view users');
    }

    public function view(User $user): bool
    {
        return $user->can('view own users');
    }

    public function create(User $user): bool
    {
        return $user->can('create users');
    }

    public function update(User $user): bool
    {
        return $user->can('edit users');
    }

    public function delete(User $user): bool
    {
        return $user->can('delete users');
    }

    public function forceDelete(User $user): bool
    {
        return $user->can('forceDelete users');
    }
}

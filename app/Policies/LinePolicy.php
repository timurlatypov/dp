<?php

namespace App\Policies;

use App\Models\Line;
use App\User;

class LinePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view lines');
    }

    public function view(User $user, Line $line): bool
    {
        return $user->can('view own lines');
    }

    public function create(User $user): bool
    {
        return $user->can('create lines');
    }

    public function update(User $user, Line $line): bool
    {
        return $user->can('edit lines');
    }

    public function delete(User $user, Line $line): bool
    {
        return $user->can('delete lines');
    }

    public function forceDelete(User $user, Line $line): bool
    {
        return $user->can('forceDelete lines');
    }
}

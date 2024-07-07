<?php

namespace App\Policies;

use App\Models\Banner;
use App\User;

class BannerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view banners');
    }

    public function view(User $user, Banner $banner): bool
    {
        return $user->can('view own banners');
    }

    public function create(User $user): bool
    {
        return $user->can('create banners');
    }

    public function update(User $user, Banner $banner): bool
    {
        return $user->can('edit banners');
    }

    public function delete(User $user, Banner $banner): bool
    {
        return $user->can('delete banners');
    }

    public function forceDelete(User $user, Banner $banner): bool
    {
        return $user->can('forceDelete banners');
    }
}

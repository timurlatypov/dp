<?php

namespace App\Policies;

use App\Models\Coupon;
use App\User;

class CouponPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view coupons');
    }

    public function view(User $user, Coupon $coupon): bool
    {
        return $user->can('view own coupons');
    }

    public function create(User $user): bool
    {
        return $user->can('create coupons');
    }

    public function update(User $user, Coupon $coupon): bool
    {
        return $user->can('edit coupons');
    }

    public function delete(User $user, Coupon $coupon): bool
    {
        return $user->can('delete coupons');
    }

    public function forceDelete(User $user, Coupon $coupon): bool
    {
        return $user->can('forceDelete coupons');
    }
}

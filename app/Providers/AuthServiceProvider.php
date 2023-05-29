<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Line;
use App\Policies\BrandPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CouponPolicy;
use App\Policies\LinePolicy;
use App\Policies\ProductPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\SubcategoryPolicy;
use App\Policies\UserPolicy;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcategory;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Banner::class  => BannerPolicy::class,
        Brand::class       => BrandPolicy::class,
        Coupon::class      => CouponPolicy::class,
        Line::class        => LinePolicy::class,
        Review::class      => ReviewPolicy::class,
        Product::class     => ProductPolicy::class,
        User::class        => UserPolicy::class,
        Category::class  => CategoryPolicy::class,
        Subcategory::class => SubcategoryPolicy::class,
    ];
}

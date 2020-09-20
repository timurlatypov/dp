<?php

namespace App\Providers;

use App\Brand;
use App\Categories;
use App\Coupon;
use App\Line;
use App\Policies\BrandPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CouponPolicy;
use App\Policies\LinePolicy;
use App\Policies\ProductPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\SubcategoryPolicy;
use App\Policies\UserPolicy;
use App\Product;
use App\Review;
use App\Subcategory;
use App\User;
use Illuminate\Support\Facades\Gate;
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
        Categories::class  => CategoryPolicy::class,
        Subcategory::class => SubcategoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

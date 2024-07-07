<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(\App\Cart\Cart::class, function () {
            return new \App\Cart\Cart();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Carbon::setLocale(config('app.locale'));

        view()->composer('layouts.partials._nav', function ($nav) {
            $nav->with('brands', Brand::orderBy('order_id')
                ->whereNotIn('id', Brand::EXCLUDE)
                ->live()
                ->get());
            $nav->with('cart', Cart::content());
            $nav->with('for_face', Category::where('slug', 'for-face')
                ->first());
            $nav->with('for_body', Category::where('slug', 'for-body')
                ->first());
            $nav->with('direct_care', Category::where('slug', 'direct-care')
                ->first());
        });

        view()->composer('layouts.partials._in_product_nav', function ($nav) {
            $nav->with('for_face', Category::where('slug', 'for-face')
                ->first());
            $nav->with('for_body', Category::where('slug', 'for-body')
                ->first());
            $nav->with('direct_care', Category::where('slug', 'direct-care')
                ->first());
        });

        view()->composer('layouts.partials._seasonal', function ($seasonal) {
            $seasonal->with('seasonal', Product::where('seasonal', true)
                ->live()
                ->take(4)
                ->get());
        });

        view()->composer('layouts.partials._bestsellers', function ($bestsellers) {
            $bestsellers->with('bestsellers', Product::where('bestseller', true)
                ->live()
                ->stock()
                ->take(4)
                ->get());
        });

        view()->composer('layouts.partials._premium', function ($bestsellers) {
            $bestsellers->with('premium', Product::where('premium', true)
                ->live()
                ->take(4)
                ->get());
        });

        view()->composer('layouts.partials._infoblock', function ($recommend) {
            $recommend->with('recommend', Product::where('recommend', true)
                ->inRandomOrder()
                ->live()
                ->stock()
                ->limit(4)
                ->get());
        });

        view()->composer('layouts.partials._carousel', function ($banners) {
            $banners->with('banners', Banner::query()
                ->where([
                    ['published_at', '<', now()],
                    ['expired_at', '>', now()],
                ])
                ->live()
                ->orderBy('sort_order')
                ->get());
        });

        view()->composer('layouts.partials._promotions', function ($promotions) {
            $promotions->with('promotions', Promotion::query()
                ->where([
                    ['published_at', '<', now()],
                    ['expired_at', '>', now()],
                ])
                ->live()
                ->orderBy('sort_order')
                ->limit(4)
                ->get());
        });

        view()->composer('admin.partials._nav', function ($orders) {
            $orders->with('new_orders_count', Order::countNewOrders());
        });

        view()->composer('admin.index', function ($orders) {
            $currentYear = date('Y');
            $currentMonth = date('m');
            $orders->with('current_month_orders_count', Order::whereRaw('MONTH(created_at) = ?', [$currentMonth])
                ->whereRaw('YEAR(created_at) = ?', [$currentYear])
                ->get());
        });
    }
}

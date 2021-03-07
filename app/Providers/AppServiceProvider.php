<?php

namespace App\Providers;

use App\Brand;
use App\Categories;
use App\Models\Banner;
use App\Order;
use App\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Carbon::setLocale(config('app.locale'));

        view()->composer('layouts.partials._nav', function ($nav) {
            $nav->with('brands', Brand::orderBy('order_id')->live()->get());
            $nav->with('cart', Cart::content());
            $nav->with('for_face', Categories::where('slug', 'for-face')->first());
            $nav->with('for_body', Categories::where('slug', 'for-body')->first());
            $nav->with('direct_care', Categories::where('slug', 'direct-care')->first());
        });


        view()->composer('layouts.partials._in_product_nav', function ($nav) {
            $nav->with('for_face', Categories::where('slug', 'for-face')->first());
            $nav->with('for_body', Categories::where('slug', 'for-body')->first());
            $nav->with('direct_care', Categories::where('slug', 'direct-care')->first());
        });


        view()->composer('layouts.partials._seasonal', function ($seasonal) {
            $seasonal->with('seasonal', Product::where('seasonal', true)->live()->take(4)->get());
        });


        view()->composer('layouts.partials._bestsellers', function ($bestsellers) {
            $bestsellers->with('bestsellers', Product::where('bestseller', true)->live()->take(4)->get());
        });

        view()->composer('layouts.partials._premium', function ($bestsellers) {
            $bestsellers->with('premium', Product::where('premium', true)->live()->take(4)->get());
        });


        view()->composer('layouts.partials._infoblock', function ($recommend) {
            $recommend->with('recommend', Product::where('recommend', true)->inRandomOrder()->live()->limit(4)->get());
        });

        view()->composer('layouts.partials._carousel', function ($banners) {
            $banners->with('banners', Banner::live()->orderBy('sort_order')->get()->filter(function ($item) {
                if (now()->between($item->published_at, $item->expired_at)) {
                    return $item;
                }
            }));
        });

        view()->composer('admin.partials._nav', function ($orders) {
            $orders->with('new_orders_count', Order::countNewOrders());
        });

        view()->composer('admin.index', function ($orders) {
            $currentYear  = date('Y');
            $currentMonth = date('m');
            $orders->with('current_month_orders_count', Order::whereRaw('MONTH(created_at) = ?', [$currentMonth])
                ->whereRaw('YEAR(created_at) = ?', [$currentYear])
                ->get());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Support\Facades\Schema;
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
	    Schema::defaultStringLength(191);

	    view()->composer('layouts.partials._nav', function($nav) {
		    $nav->with('brands', \App\Brand::orderBy('order_id')->get());
		    $nav->with('cart', \Gloudemans\Shoppingcart\Facades\Cart::content() );
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

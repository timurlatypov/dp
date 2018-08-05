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
		    $nav->with('for_body', \App\Categories::where('slug', 'for-body')->first() );
	    });

	    view()->composer('layouts.partials._seasonal', function($seasonal) {
		    $seasonal->with('seasonal', \App\Product::where('seasonal', true)->take(3)->get());
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

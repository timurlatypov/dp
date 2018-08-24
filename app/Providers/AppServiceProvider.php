<?php

namespace App\Providers;

use Carbon\Carbon;
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
	    Carbon::setLocale(config('app.locale'));

	    Schema::defaultStringLength(191);

	    view()->composer('layouts.partials._nav', function($nav) {
		    $nav->with('brands', \App\Brand::orderBy('order_id')->get());
		    $nav->with('cart', \Gloudemans\Shoppingcart\Facades\Cart::content() );
		    $nav->with('for_face', \App\Categories::where('slug', 'for-face')->first() );
		    $nav->with('for_body', \App\Categories::where('slug', 'for-body')->first() );
		    $nav->with('direct_care', \App\Categories::where('slug', 'direct-care')->first() );
	    });



	    view()->composer('layouts.partials._in_product_nav', function($nav) {
		    $nav->with('for_face', \App\Categories::where('slug', 'for-face')->first() );
		    $nav->with('for_body', \App\Categories::where('slug', 'for-body')->first() );
		    $nav->with('direct_care', \App\Categories::where('slug', 'direct-care')->first() );
	    });



	    view()->composer('layouts.partials._seasonal', function($seasonal) {
		    $seasonal->with('seasonal', \App\Product::where('seasonal', true)->take(4)->get());
	    });

	    view()->composer('layouts.partials._bestsellers', function($bestsellers) {
		    $bestsellers->with('bestsellers', \App\Product::where('bestseller', true)->take(4)->get());
	    });

	    view()->composer('layouts.partials._infoblock', function($recommend) {
		    $recommend->with('recommend', \App\Product::where('bestseller', true)->take(2)->get());
	    });

	    view()->composer('admin.partials._nav', function($orders) {
		    $orders->with('new_orders_count', \App\Order::countNewOrders());
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

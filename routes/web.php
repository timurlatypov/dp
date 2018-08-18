<?php

Auth::routes();

//Route::get('/managers', function() {
//
//	dd( optional(auth()->user()) );
//
//	$managers = \App\Role::where('name', 'manager')->first()->users()->pluck('email')->toArray();
//	dd($managers);
//});
//
//

Route::get('/order', function() {
	$order = \App\Order::first();
	return new \App\Mail\NewOrder($order);
});

Route::get('/', 'HomeController@index')->name('landing-page');
Route::get('/novelties', 'HomeController@novelties')->name('novelties');
Route::get('/bestsellers', 'HomeController@bestsellers')->name('bestsellers');
Route::get('/discounts', 'HomeController@discounts')->name('discounts');

Route::group(['prefix' => '/category'], function() {
	Route::get('/{categories}', 'HomeController@category')->name('show.category');;
	Route::get('/{categories}/{subcategory}', 'HomeController@subcategory')->name('show.category.subcategory');;
});


Route::get('/brand/{brand}/{product}', 'AdminPanel\Brand\BrandController@show_product')->name('show.product');
Route::get('/brand/{brand}', 'AdminPanel\Brand\BrandController@show_brand_products')->name('show.brand.products');
Route::get('/brand/{brand}/line/{line}', 'AdminPanel\Brand\BrandController@show_brand_line_products')->name('show.brand.line.products');


//Route::group(['middleware' => 'role:admin'], function() {
//
//	Route::group(['middleware' => 'role:admin,delete posts'], function() {
//		Route::get('/admin/users', function () {
//			return 'you can delete posts';
//		});
//	});
//
//	Route::get('/admin', function () {
//		return 'admin panel entered';
//	});
//});

Route::group(['prefix' => '/cart'], function() {
	Route::post('/add', 'CartController@store')->name('add.product.to.cart');
	Route::get('/refresh', 'CartController@refresh')->name('refresh.items.in.cart');
});

Route::group(['prefix' => '/favorite', 'middleware' => 'auth', 'namespace' => 'User'], function() {
	Route::get('/{product}/attach', 'FavoriteController@attachProductToFavorite')->name('attach.product.to.favorite');
	Route::get('/{product}/detach', 'FavoriteController@detachProductFromFavorite')->name('detach.product.from.favorite');
});

Route::group(['prefix' => '/checkout'], function() {
	Route::get('/', 'CheckoutController@index')->name('checkout');
	Route::post('/add', 'CheckoutController@add_qty_to_item')->name('add.qty.to.item');
	Route::post('/remove', 'CheckoutController@remove_qty_to_item')->name('add.qty.to.item');
	Route::delete('/delete/{rowId}', 'CheckoutController@destroy')->name('delete.item.from.cart');
});

/////////////////////////////////////////////////////////////////
//
//          ORDER CONTROLLER
//
/////////////////////////////////////////////////////////////////
Route::group(['prefix' => '/order'], function() {
	Route::post('/store', 'OrderController@store')->name('order.store');
});



/////////////////////////////////////////////////////////////////
//
//          USER ACCOUNT CONTROLLER
//
/////////////////////////////////////////////////////////////////
Route::group(['prefix' => '/account', 'middleware' => 'auth', 'namespace' => 'Account'], function() {
	Route::get('/profile', 'AccountController@profile')->name('account.profile');
	Route::patch('/profile/update', 'AccountController@profile_update')->name('account.profile.update');

	Route::get('/addresses', 'AccountController@addresses')->name('account.addresses');
	Route::get('/orders', 'AccountController@orders')->name('account.orders');
	Route::get('/favorite', 'AccountController@favorites')->name('account.favorite');
	Route::get('/loyalty', 'AccountController@loyalty')->name('account.loyalty');

});

/////////////////////////////////////////////////////////////////
//
//          COUPON CONTROLLER
//
/////////////////////////////////////////////////////////////////
Route::group(['prefix' => '/coupon'], function() {
	Route::get('/', 'CouponController@index')->name('coupon.index');
	Route::get('/destroy', 'CouponController@destroy')->name('coupon.destroy');
	Route::post('/validate', 'CouponController@validate_coupon')->name('validate.coupon');
});

/////////////////////////////////////////////////////////////////
//
//          ADMIN PANEL CONTROLLER
//
/////////////////////////////////////////////////////////////////
Route::group(['prefix' => '/admin-panel', 'middleware' => 'role:admin,manager', 'namespace' => 'AdminPanel'], function() {
	Route::get('/', 'AdminController@index')->name('admin.index');
	//
	// PRODUCTS GROUP
	//
	Route::group(['prefix' => '/products', 'namespace' => 'Product'], function() {
		Route::get('/', 'ProductController@index')->name('admin.product.index');
		Route::get('/create', 'ProductController@create')->name('admin.product.create');
		Route::post('/store', 'ProductController@store')->name('admin.product.store');
		Route::get('/{id}/edit', 'ProductController@edit')->name('admin.product.edit');
		Route::patch('/{product}', 'ProductController@update')->name('admin.product.update');

		// API input field 'price' update
		Route::post('/price/update', 'ProductController@price')->name('api.product.price.update');

		// API input field 'discount' update
		Route::post('/discount/update', 'ProductController@discount')->name('api.product.discount.update');

		// API 'live' toggle
		Route::post('/live/toggle', 'ProductController@toggle')->name('api.product.live.toggle');
	});
	//
	// CATEGORIES / SUBCATEGORIES GROUP
	//
	Route::group(['prefix' => '/categories', 'namespace' => 'Categories'], function() {
		Route::get('/', 'CategoriesController@index')->name('');

		Route::post('/{categories}/store', 'SubcategoriesController@store')->name('store.new.subcategory');
	});
	//
	// ORDERS GROUP
	//
	Route::group(['prefix' => '/orders', 'namespace' => 'Orders'], function() {
		Route::get('/', 'OrdersController@index')->name('admin.orders.index');
		Route::get('/{order}/show', 'OrdersController@show')->name('admin.orders.show');
		Route::post('/assign', 'OrdersController@assign')->name('admin.orders.assign');
		Route::delete('/delete', 'OrdersController@destroy')->name('admin.orders.destroy');
		Route::post('/change', 'OrdersController@change')->name('admin.orders.change.status');
	});




	Route::group(['prefix' => '/images', 'namespace' => 'Images'], function() {
		Route::post('/store', 'ImageController@store_product_image')->name('api.store.product.image');
	});

	Route::group(['prefix' => '/api', 'namespace' => 'Brand'], function() {
		Route::post('/brands', 'BrandController@index')->name('api.get.product.brands');
	});

	Route::group(['prefix' => '/api', 'namespace' => 'Line'], function() {
		Route::post('/lines', 'LineController@show_all_lines_for_brand')->name('api.get.product.lines');
	});

	Route::group(['prefix' => '/api', 'namespace' => 'Seasonal'], function() {
		Route::post('/seasonal/toggle', 'SeasonalController@toggle')->name('api.seasonal.toggle');
	});

	Route::group(['prefix' => '/api', 'namespace' => 'Bestseller'], function() {
		Route::post('/bestseller/toggle', 'BestsellerController@toggle')->name('api.bestseller.toggle');
	});

	Route::group(['prefix' => '/api', 'namespace' => 'Novelty'], function() {
		Route::post('/novelty/toggle', 'NoveltyController@toggle')->name('api.novelty.toggle');
	});
});



Route::get('/home', 'HomeController@index')->name('home');


<?php

Auth::routes();

Route::get('/', function () {
    return view('landing-page');
});

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

Route::group(['prefix' => '/admin-panel', 'middleware' => 'role:admin', 'namespace' => 'AdminPanel'], function() {
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
});



Route::get('/home', 'HomeController@index')->name('home');


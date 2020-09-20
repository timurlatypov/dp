<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => '/auth', 'namespace' => 'Auth\Api'], function() {
	Route::post('register', 'RegisterController@register')->name('api.register');
});

Route::group(['namespace' => 'API'], function() {
    Route::group(['prefix' => '/v1', 'namespace' => 'V1'], function() {
        Route::get('/{level}/options', 'CouponOptionsController@get');
        Route::get('search', 'SearchController@getDadata');
        Route::get('get-price', 'SearchController@getCDEKPrices');
    });
});


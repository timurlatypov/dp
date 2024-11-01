<?php

use App\Http\Controllers\HomeController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::middleware(ProtectAgainstSpam::class)->group(function () {
    Auth::routes();
});

Route::get('/', [HomeController::class, 'index'])->name('landing-page');
Route::get('/novelties', [HomeController::class, 'novelties'])->name('novelties');
Route::get('/bestsellers', 'HomeController@bestsellers')->name('bestsellers');
Route::get('/care-programs', 'HomeController@carePrograms')->name('care-programs');
Route::get('/premium', 'HomeController@premium')->name('premium');
Route::get('/8march', [HomeController::class, 'eightMarch'])->name('eightMarch');
Route::get('/14feb', [HomeController::class, 'fourteenthFeb'])->name('fourteenthFeb');
Route::get('/set', 'HomeController@set')->name('set');
Route::get('/discounts', 'HomeController@discounts')->name('discounts');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::get('/confidentiality', 'HomeController@confidentiality')->name('confidentiality');
Route::get('/delivery', 'HomeController@delivery')->name('delivery');
Route::get('/sdek', 'HomeController@sdek')->name('sdek');
Route::get('/sdek-points', 'HomeController@sdekPoints')->name('sdek.points');
Route::get('/bookmarks', 'HomeController@bookmarks')->name('bookmarks');

// Online payment routes for SUCCESS and FAILURE statuses
Route::get('/payment-check', 'OrderController@check')->name('payment.check');
Route::get('/payment-success', 'OrderController@success')->name('payment.success');
Route::get('/success', 'HomeController@success')->name('page.success');

Route::get('/payment-failure', 'OrderController@failure')->name('payment.failure');
Route::get('/failure', 'HomeController@failure')->name('page.failure');

// ///////////////////////////////////////////////////////////////
//
//  BILLING
//
// ///////////////////////////////////////////////////////////////
Route::group(['prefix' => '/billing', 'namespace' => 'Billing'], function () {
    Route::group(['prefix' => '/gateway', 'namespace' => 'Gateway'], function () {
        Route::get('/{order}/register', 'PaymentController@register')->name('billing.gateway.registerOrder');
        Route::get('/{hash}/invalidate', 'PaymentController@invalidate')->name('billing.gateway.invalidatePaymentLink');
        Route::get('/{order}/sendLink', 'PaymentController@sendLink')->name('billing.gateway.sendLink');

        Route::get('/success', 'PaymentController@success')->name('billing.gateway.payment.success');
        Route::get('/failed', 'PaymentController@failed')->name('billing.gateway.payment.failed');
    });

    Route::group(['prefix' => '/postback', 'namespace' => 'Postback'], function () {
        Route::get('/{gateway}', 'PostbackController@check')->name('billing.postback.check');
    });
});

Route::group(['prefix' => '/category'], function () {
    Route::get('/{categories}', 'HomeController@category')->name('show.category');
    Route::get('/{categories}/{subcategory}', 'HomeController@subcategory')->name('show.category.subcategory');
});

Route::get('/brand/{brand}/{product}', 'AdminPanel\Brand\BrandController@show_product')->name('show.product');
Route::get('/brand/{brand}', 'AdminPanel\Brand\BrandController@show_brand_products')->name('show.brand.products');
Route::get('/brand/{brand}/line/{line}', 'AdminPanel\Brand\BrandController@show_brand_line_products')->name('show.brand.line.products');

Route::group(['prefix' => '/cart'], function () {
    Route::post('/add', 'CartController@store')->name('add.product.to.cart');
    Route::get('/refresh', 'CartController@refresh')->name('refresh.items.in.cart');
});

Route::group(['prefix' => '/favorite', 'middleware' => 'auth', 'namespace' => 'User'], function () {
    Route::get('/{product}/attach', 'FavoriteController@attachProductToFavorite')->name('attach.product.to.favorite');
    Route::get('/{product}/detach', 'FavoriteController@detachProductFromFavorite')->name('detach.product.from.favorite');
});

Route::group(['prefix' => '/checkout'], function () {
    Route::get('/', 'CheckoutController@index')->name('checkout');
    Route::post('/add', 'CheckoutController@add_qty_to_item')->name('add.qty.to.item');
    Route::post('/remove', 'CheckoutController@remove_qty_to_item')->name('remove.qty.to.item');
    Route::delete('/delete/{rowId}', 'CheckoutController@destroy')->name('delete.item.from.cart');
});

// ///////////////////////////////////////////////////////////////
//
//          ORDER CONTROLLER
//
// ///////////////////////////////////////////////////////////////
Route::group(['prefix' => '/order'], function () {
    Route::post('/store', 'OrderController@store')->name('order.store');
});

// ///////////////////////////////////////////////////////////////
//
//          USER ACCOUNT CONTROLLER
//
// ///////////////////////////////////////////////////////////////
Route::group(['prefix' => '/account', 'middleware' => 'auth', 'namespace' => 'Account'], function () {
    Route::get('/profile', 'AccountController@profile')->name('account.profile');
    Route::patch('/profile/update', 'AccountController@profile_update')->name('account.profile.update');

    Route::get('/addresses', 'AccountController@addresses')->name('account.addresses');
    Route::get('/orders', 'AccountController@orders')->name('account.orders');
    Route::get('/favorite', 'AccountController@favorites')->name('account.favorite');

    Route::group(['prefix' => '/review', 'namespace' => 'Review'], function () {
        Route::get('/', 'ReviewController@show')->name('account.review.show');
        Route::post('/create', 'ReviewController@create')->name('account.review.create');
        Route::post('/delete', 'ReviewController@delete')->name('account.review.delete');
        Route::get('/parse', 'ReviewController@parse');
    });
});

// ///////////////////////////////////////////////////////////////
//
//          USER COUPON CONTROLLER
//
// ///////////////////////////////////////////////////////////////
Route::group(['prefix' => '/coupon'], function () {
    Route::get('/destroy', 'CouponController@destroy')->name('coupon.destroy');
    Route::post('/validate', 'CouponController@validateCoupon')->name('validate.coupon');
});

// ///////////////////////////////////////////////////////////////
//
//          GIFT CARDS CONTROLLER
//
// ///////////////////////////////////////////////////////////////
Route::group(['prefix' => '/gift-card'], function () {
    Route::get('/cancel', 'GiftCardController@cancel')->name('gift-card.cancel');
    Route::post('/apply', 'GiftCardController@apply')->name('gift-card.apply');
});

// ///////////////////////////////////////////////////////////////
//
//          ADMIN PANEL CONTROLLER
//
// ///////////////////////////////////////////////////////////////
Route::group(['prefix' => '/admin-panel', 'middleware' => 'role:admin|manager|super-admin', 'namespace' => 'AdminPanel'], function () {
    //
    // ADMIN PANEL INDEX
    //
    Route::get('/', 'AdminController@index')->name('admin.index');
    //
    // PRODUCTS GROUP
    //
    Route::group(['prefix' => '/products', 'namespace' => 'Product'], function () {
        Route::get('/', 'ProductController@index')->name('admin.product.index');
        Route::get('/create', 'ProductController@create')->name('admin.product.create');
        Route::post('/store', 'ProductController@store')->name('admin.product.store');
        Route::get('/{id}/edit', 'ProductController@edit')->name('admin.product.edit');

        Route::get('/{id}/delete', 'ProductController@destroy')->name('admin.product.delete');
        Route::get('/{id}/forceDelete', 'ProductController@forceDelete')->name('admin.product.forceDelete');

        Route::patch('/{product}', 'ProductController@update')->name('admin.product.update');
        Route::patch('/{product}/associate/related', 'ProductController@productAssociateRelated')->name('admin.product.associate.related');

        // API input field 'price' update
        Route::post('/price/update', 'ProductController@price')->name('api.product.price.update');

        // API input field 'discount' update
        Route::post('/discount/update', 'ProductController@discount')->name('api.product.discount.update');

        // API 'live' toggle
        Route::post('/live/toggle', 'ProductController@toggle')->name('api.product.live.toggle');

        // API 'stock' toggle
        Route::post('/stock/toggle', 'ProductController@stockToggle')->name('api.product.stock.toggle');
    });

    //
    // DISCOUNT
    //
    Route::group(['prefix' => '/discount', 'namespace' => 'Discount'], function () {
        Route::get('/', 'DiscountController@index')->name('admin.discount.index');
        Route::post('/update', 'DiscountController@update')->name('admin.discount.update');
    });

    //
    // CATEGORIES / SUBCATEGORIES GROUP
    //
    Route::group(['prefix' => '/categories', 'namespace' => 'Categories'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.categories.index');
        Route::get('/{categories}/products', 'CategoryController@categoriesProducts')->name('admin.categories.products');
        Route::get('/{categories}/{subcategory}/products', 'CategoryController@subcategoriesProducts')->name('admin.categories.subcategory.products');
        Route::patch('/{categories}/products/associate', 'CategoryController@categoryAssociateProducts')->name('admin.categories.associate.products');
        Route::patch('/{categories}/{subcategory}/products/associate', 'CategoryController@subcategoryAssociateProducts')->name('admin.categories.subcategory.associate.products');
        Route::post('/{categories}/store', 'CategoryController@store')->name('store.new.subcategory');
    });

    //
    // ORDERS GROUP
    //
    Route::group(['prefix' => '/orders', 'namespace' => 'Orders'], function () {
        Route::get('/', 'OrderController@index')->name('admin.orders.index');
        Route::get('/create', 'OrderController@create')->name('admin.orders.create');
        Route::post('/store', 'OrderController@store')->name('admin.orders.store');
        Route::get('/{order}/show', 'OrderController@show')->name('admin.orders.show');
        Route::get('/{order}/edit_details', 'OrderController@edit_details')->name('admin.orders.edit_details');
        Route::get('/{order}/edit', 'OrderController@edit')->name('admin.orders.edit');
        Route::patch('/update', 'OrderController@update')->name('admin.orders.update');
        Route::patch('/{order}/update_details', 'OrderController@update_details')->name('admin.orders.update_details');

        Route::get('/{order}/register', 'OrderController@registerOrder')->name('admin.orders.registerOrder');
        Route::get('/{order}/resend', 'OrderController@resendConfirmationEmail')->name('admin.orders.resendConfirmation');

        Route::get('/{id}/reverse', 'OrderController@reverseOrder')->name('admin.orders.reverseOrder');
        Route::get('/{id}/decline', 'OrderController@declineOrder')->name('admin.orders.declineOrder');
        Route::get('/{id}/delete', 'OrderController@deleteLink')->name('admin.orders.deleteLink');
        Route::get('/{id}/status', 'OrderController@orderStatus')->name('admin.orders.orderStatus');
        Route::get('/{order}/send-link', 'OrderController@sendLink')->name('admin.orders.sendLink');

        Route::post('/assign', 'OrderController@assign')->name('admin.orders.assign');
        Route::delete('/delete', 'OrderController@destroy')->name('admin.orders.destroy');
        Route::post('/change', 'OrderController@change')->name('admin.orders.change.status');
        Route::post('/payment', 'OrderController@changePayment')->name('admin.orders.change.payment');
    });

    //
    // COUPONS GROUP
    //
    Route::group(['prefix' => '/coupons', 'namespace' => 'Coupons'], function () {
        Route::get('/', 'CouponController@index')->name('admin.coupons.index');
        Route::post('/store', 'CouponController@store')->name('admin.coupons.store');
    });

    //
    // DESIGN GROUP
    //
    Route::group(['prefix' => '/design', 'namespace' => 'Design'], function () {
        Route::get('/', 'DesignController@index')->name('admin.design.index');
        // CAROUSEL
        Route::group(['prefix' => '/carousel', 'namespace' => 'Carousel'], function () {
            Route::get('/', 'CarouselController@index')->name('admin.design.carousel');
            Route::get('/create', 'CarouselController@create')->name('admin.design.carousel.create');
            Route::post('/store', 'CarouselController@store')->name('admin.design.carousel.store');
            Route::post('/store/image', 'CarouselController@store_image')->name('admin.design.carousel.store.image');
            Route::delete('/destroy', 'CarouselController@destroy')->name('admin.design.carousel.destroy');
            Route::patch('/update', 'CarouselController@update')->name('admin.design.carousel.update');
            // API 'live' toggle
            Route::post('/live/toggle', 'CarouselController@toggle')->name('api.carousel.live.toggle');
        });
    });

    //
    // API SPECIAL ROUTES
    //
    Route::group(['prefix' => '/images', 'namespace' => 'Images'], function () {
        Route::post('/store', 'ImageController@store_product_image')->name('api.store.product.image');
    });
    Route::group(['prefix' => '/api', 'namespace' => 'Brand'], function () {
        Route::post('/brands', 'BrandController@index')->name('api.get.product.brands');
    });
    Route::group(['prefix' => '/api', 'namespace' => 'Line'], function () {
        Route::post('/lines', 'LineController@show_all_lines_for_brand')->name('api.get.product.lines');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/callback/store', 'CallbackController@store')->name('callback.store');
Route::post('/bookmark/store', 'BookmarkController@store')->name('save.product.to.bookmark');

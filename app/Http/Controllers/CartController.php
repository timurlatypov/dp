<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addToCart = \Gloudemans\Shoppingcart\Facades\Cart::add([
        	'id' => $request->id,
	        'name' => $request->title_eng,
	        'qty' => 1,
	        'price' => $request->price,
	        'options' => [
		        'title_rus' => $request->title_rus,
	        	'discount' => $request->discount,
	        	'product_slug' => $request->slug,
	        	'brand' => $request->brand['name'],
	        	'brand_slug' => $request->brand['slug'],
		        'image' => $request->thumb_path
	        ]
        ]);
        return response(['data' => \Gloudemans\Shoppingcart\Facades\Cart::content()], 200);
    }

	public function refresh()
	{
		$cart_items = \Gloudemans\Shoppingcart\Facades\Cart::content();
		$cart_count = $cart_items->count();
		$cart_total = \Gloudemans\Shoppingcart\Facades\Cart::total();

		return response(['cart_items' => $cart_items, 'cart_count' => $cart_count, 'cart_total' => $cart_total], 200);
	}
}

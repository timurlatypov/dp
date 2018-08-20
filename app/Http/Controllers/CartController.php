<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
	        'price' => $request->priceToShow,
	        'options' => [
	        	'product_slug' => $request->slug,
	        	'brand' => $request->brand['name'],
	        	'brand_slug' => $request->brand['slug'],
		        'image' => $request->thumb_path
	        ]
        ]);
        return response(['data' => \Gloudemans\Shoppingcart\Facades\Cart::content()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

	public function refresh()
	{
		$cart_items = \Gloudemans\Shoppingcart\Facades\Cart::content();
		$cart_count = $cart_items->count();
		$cart_total = \Gloudemans\Shoppingcart\Facades\Cart::total();

		return response(['cart_items' => $cart_items, 'cart_count' => $cart_count, 'cart_total' => $cart_total], 200);
	}
}

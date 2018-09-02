<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$cart = Cart::content();
    	$subtotal = Cart::subtotal();
	    return view('checkout', compact(['cart', 'subtotal']));
    }

    /**
     * Delete the specified item from cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
	    Cart::remove($rowId);
	    $cart = Cart::content();
	    $subtotal = Cart::subtotal();
	    return response(['cart' => $cart, 'subtotal' => $subtotal], 200);
    }

	public function add_qty_to_item(Request $request)
	{
		$rowId = $request->rowId;
		Cart::update($rowId, $request->qty+1);
		$cart = Cart::content();
		$subtotal = Cart::subtotal();
		return response(['cart' => $cart, 'subtotal' => $subtotal], 200);
	}

	public function remove_qty_to_item(Request $request)
	{
		$rowId = $request->rowId;
		Cart::update($rowId, $request->qty-1);
		$cart = Cart::content();
		$subtotal = Cart::subtotal();
		return response(['cart' => $cart, 'subtotal' => $subtotal], 200);
	}
}

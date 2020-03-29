<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckoutController extends Controller
{
    private $cart;

    public function __construct(\Gloudemans\Shoppingcart\Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $cart     = $this->cart->content();
        $subtotal = $this->cart->subtotal();

        return view('checkout', compact(['cart', 'subtotal']));
    }

    /**
     * Delete the specified item from cart.
     *
     * @param $rowId
     *
     * @return Response
     */
    public function destroy($rowId)
    {
        $this->cart->remove($rowId);

        return response(['cart' => $this->cart->content()], 200);
    }

    public function add_qty_to_item(Request $request)
    {
        $rowId = $request->rowId;
        $this->cart->update($rowId, $request->qty + 1);

        return response(['cart' => $this->cart->content()], 200);
    }

    public function remove_qty_to_item(Request $request)
    {
        $rowId = $request->rowId;
        $this->cart->update($rowId, $request->qty - 1);

        return response(['cart' => $this->cart->content()], 200);
    }
}

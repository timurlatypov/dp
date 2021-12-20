<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckoutController extends Controller
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $cart = $this->cart->content();
        $total = $this->cart->total();
        $subtotal = $this->cart->subtotal();

        return view('checkout', compact(['cart', 'total', 'subtotal']));
    }

    /**
     * Delete the specified item from cart.
     *
     * @param $rowId
     *
     * @return Application|ResponseFactory|Response
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

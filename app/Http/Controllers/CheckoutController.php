<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckoutController extends Controller
{
    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
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
     * @return Response|ResponseFactory
     */
    public function destroy($rowId)
    {
        $this->cart->remove($rowId);

        return response(['cart' => $this->cart->content()], 200);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function add_qty_to_item(Request $request)
    {
        $rowId = $request->rowId;
        $this->cart->update($rowId, $request->qty + 1);

        return response(['cart' => $this->cart->content()], 200);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function remove_qty_to_item(Request $request)
    {
        $rowId = $request->rowId;
        $this->cart->update($rowId, $request->qty - 1);

        return response(['cart' => $this->cart->content()], 200);
    }
}

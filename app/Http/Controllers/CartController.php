<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    private $cart;

    /**
     * Helper function
     *
     * @param $id
     *
     * @return int
     */
    private function isCouponDiscount($id)
    {
        $value  = 0;
        $coupon = session()->get('coupon');
        if ($coupon && $coupon->brand_id == $id) {
            $value = $coupon->discount;
        }

        return $value;
    }

    /**
     * CartController constructor.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->cart->add([
            'id'      => $request->id,
            'name'    => $request->title_eng,
            'qty'     => 1,
            'price'   => $request->price,
            'options' => [
                'title_rus'    => $request->title_rus,
                'vendor_code'  => $request->vendor_code,
                'discount'     => $request->discount,
                'product_id'   => $request->id,
                'product_slug' => $request->slug,
                'brand'        => $request->brand['name'],
                'brand_id'     => $request->brand['id'],
                'brand_slug'   => $request->brand['slug'],
                'image'        => $request->thumb_path,
                'coupon'       => $this->isCouponDiscount($request->brand['id']),
            ],
        ]);

        return response(['data' => $this->cart->content()], 200);
    }

    public function refresh()
    {
        $cart_items = $this->cart->content();
        $cart_count = $cart_items->count();
        $cart_total = $this->cart->total();

        return response([
            'cart_items' => $cart_items,
            'cart_count' => $cart_count,
            'cart_total' => $cart_total,
        ], 200);
    }
}

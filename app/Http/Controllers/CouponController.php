<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Services\Coupon\DiscountLevel;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CouponController extends Controller
{
    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @return Response|ResponseFactory
     */
    public function destroy()
    {
        request()->session()->forget('coupon');

        foreach ($this->cart->content() as $rowId => $item) {
            $item->options['coupon'] = null;
            $this->cart->update($rowId, ['options' => $item->options]);
        }

        return response(['cart' => $this->cart->content()], 200);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function validateCoupon(Request $request)
    {
        $coupon = Coupon::where([
            ['coupon', '=', $request->get('coupon')],
            ['expired_at', '>=', now()],
            ['used', '=', 0],
        ])->first();

        if (empty($coupon)) {
            return response(['message' => 'Промокод недействителен'], 202);
        }

        $request->session()->put('coupon', $coupon);

        switch ($coupon->level) {
            case 'product':
                DiscountLevel::product($this->cart, $coupon);
                break;
            case 'line':
                // logic for brand line products
                break;
            case 'brand':
                DiscountLevel::brand($this->cart, $coupon);
                break;
            case 'all':
                DiscountLevel::all($this->cart, $coupon);
                break;
        }

        return response([
            'coupon' => $coupon,
            'cart' => $this->cart->content(),
        ], 200);
    }
}

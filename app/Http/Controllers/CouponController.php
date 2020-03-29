<?php

namespace App\Http\Controllers;

use App\Coupon;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CouponController extends Controller
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

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
     * @param Request $request
     *
     * @return ResponseFactory|Response
     */
    public function validateCoupon(Request $request)
    {
        if ($coupon = Coupon::where('coupon', $request->coupon)->first()) {
            if ($coupon->expired_at > now()) {
                if (!$coupon->used) {
                    $request->session()->put('coupon', $coupon);

                    foreach ($this->cart->content() as $rowId => $item) {
                        // чтобы отключить наборы && $item->options['brand_id'] != 11
                        if ($item->options['brand_id'] == $coupon->brand_id || $coupon->brand_id == 0) {
                            $item->options['coupon'] = $coupon->discount;
                            $this->cart->update($rowId, ['options' => $item->options]);
                        }
                    }

                    return response([
                        'coupon' => $coupon,
                        'cart'   => $this->cart->content(),
                    ], 200);
                }

                return response(['message' => 'промокод уже использован'], 202);
            }

            return response(['message' => 'промокод недействителен'], 202);
        }

        return response(['message' => 'промокод не найден'], 202);
    }
}

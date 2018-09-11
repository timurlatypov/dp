<?php

namespace App\Http\Controllers;

use App\Coupon;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

class CouponController extends Controller
{


	public function destroy()
	{
		return request()->session()->forget('coupon');
	}

	public function validate_coupon(Request $request)
	{
		if ( $coupon = Coupon::where('coupon', $request->coupon)->first() ) {
			if ( $coupon->expired_at > now() ) {
				if (!$coupon->used) {
					$request->session()->put('coupon', $coupon);
					return response(['coupon' => $coupon], 200);
				}
				return response(['message' => 'промокод уже использован'], 202);
			}
			return response(['message' => 'промокод недействителен'], 202);
		}
		return response(['message' => 'промокод не найден'], 202);
	}
}

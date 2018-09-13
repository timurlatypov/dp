<?php

namespace App\Http\Controllers\AdminPanel\Coupons;

use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
	public function index()
	{
		$coupons = Coupon::all();
		return view('admin.coupons.index', compact('coupons'));
	}

	public function create()
	{
		return view('admin.coupons.create');
	}

	public function store(Request $request, Coupon $coupon)
	{
		$number = strtoupper(bin2hex(random_bytes(5)));
		$coupon->create([
			'coupon' => $number,
			'discount' => $request->discount,
			'reusable' => $request->reusable,
			'expired_at' => $request->expired_at,
		]);
	}

	public function destroy()
	{
		return request()->session()->forget('coupon');
	}
}

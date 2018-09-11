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

	public function store(Request $request)
	{

		//$coupon = strtoupper(bin2hex(random_bytes(5)));
		//echo $coupon;

	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy()
	{
		return request()->session()->forget('coupon');
	}

}

<?php

namespace App\Http\Controllers\AdminPanel\Coupons;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request, Coupon $coupon): void
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

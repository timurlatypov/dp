<?php

namespace App\Http\Controllers\AdminPanel\Coupons;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $coupons = Coupon::all();

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * @return Factory|View
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

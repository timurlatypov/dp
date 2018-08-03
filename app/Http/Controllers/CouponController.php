<?php

namespace App\Http\Controllers;

use App\Coupon;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

class CouponController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {

    	$coupon = random_bytes(5);

	    echo(strtoupper(bin2hex($coupon)));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}


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
			return response(['message' => 'промокод не действителен'], 202);
		}
		return response(['message' => 'промокод не найден'], 202);
	}
}

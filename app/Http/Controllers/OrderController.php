<?php

namespace App\Http\Controllers;

use App\Order;
use App\Coupon;
use App\Events\NewOrderCreated;
use App\Role;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function index()
	{

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

		//dd($request);

		if ( auth()->check() ) {
			$user_id = $request->user()->id;
		} else {
			$user_id = null;
		}

		if ( $request->coupon['coupon'] ) {
			$hasCoupon = true;
		} else {
			$hasCoupon = false;
		}

		$order = Order::create([
			'user_id' => $user_id,
			'order_details' => json_encode($request->cart),
			'order_status' => 'Новый',
			'coupon' => $hasCoupon,
			'coupon_details' => json_encode($request->coupon),
			'billing_name' => $request->user['name'],
			'billing_surname' => $request->user['surname'],
			'billing_phone' => $request->user['phone'],
			'billing_email' => $request->user['email'],
			'billing_city' => $request->address['billing_city'],
			'billing_street' => $request->address['billing_street'],
			'billing_house' => $request->address['billing_house'],
			'billing_apartment' => $request->address['billing_apartment'],
			'billing_entrance' => $request->address['billing_entrance'],
			'billing_floor' => $request->address['billing_floor'],
			'billing_comment' => $request->address['billing_comment'],
			'billing_subtotal' => $request->billing_subtotal,
			'billing_loyalty' => $request->user['loyalty'],
			'billing_delivery' => $request->billing_delivery,
			'billing_total' => $request->billing_total,

		]);

		$coupon = Coupon::where('coupon', $request->coupon['coupon'])->first();

		if ( $coupon && !$coupon->reusable ) {
			$coupon->update([
				'used' => true,
			]);
		}

		$customer = $request->user['email'];
		$managers = Role::where('name', 'manager')->first()->users()->pluck('email')->toArray();

		event(new NewOrderCreated($order, $customer, $managers));

		request()->session()->forget('coupon');

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

	/**
	 * Delete the specified item from cart.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}

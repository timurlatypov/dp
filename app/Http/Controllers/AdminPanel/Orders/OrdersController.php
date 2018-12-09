<?php

namespace App\Http\Controllers\AdminPanel\Orders;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Filters\Product\{ BrandFilter };

class OrdersController extends Controller
{

	private $coupon;

	public function index(Request $request)
	{
		$orders = Order::orderBy('created_at', 'desc')
			->paginate(20);
		return view('admin.orders.index', compact('orders'));
	}




	public function assign(Request $request)
	{
		$order = Order::find( (int)$request->id );
		$manager = User::find( (int)$request->managerid );

		$order->manager()->associate($manager);
		$order->save();

		return redirect()->back();
	}

	public function show(Order $order)
	{
		$details = json_decode($order->order_details);

		if ($order->coupon_details) {
			$coupon = json_decode($order->coupon_details);
		}

		return view('admin.orders.show', compact(['order','details','coupon']));
	}






	public function edit(Order $order)
	{
		$details = json_decode($order->order_details);

		//dd($details);

		return view('admin.orders.edit', compact(['order','details']));
	}

	public function update(Request $request)
	{
		$order = Order::find($request->id);

		$order->update([
			'order_details' => $request->details,
			'billing_total' => $request->billing_total
		]);

		return response(['data' => 'Успешно'], 200);
	}







	public function destroy(Request $request)
	{
		$order = Order::find($request->id);

		$order->delete();

		return redirect()->back()->with('flash', 'Заказ '.$order->order_id.' удалён');
	}


	public function change(Request $request)
	{

		$order = Order::find($request->id);
		$order->update([
			'order_status' => $request->order_status
		]);
		return redirect()->back();
	}
}

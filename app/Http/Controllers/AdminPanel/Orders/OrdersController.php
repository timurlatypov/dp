<?php

namespace App\Http\Controllers\AdminPanel\Orders;

use App\Jobs\SendSberbankPaymentLink;
use App\Order;
use App\Sberbank;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Voronkovich\SberbankAcquiring\Client;
use Voronkovich\SberbankAcquiring\OrderStatus;

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

	public function create()
	{
		return view('admin.orders.create');
	}

	public function store(Request $request)
	{
		if ( $request->user_id ) {
			$user_id = $request->user_id;
		} else {
			$user_id = null;
		}

		$order = Order::create([
			'user_id' => $user_id,
			'order_details' => $request->details,
			'order_status' => 'Новый',
			'coupon' => 0,
			'coupon_details' => null,

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

			'billing_subtotal' => $request->billing_total,
			'billing_delivery' => $request->billing_delivery,
			'billing_total' => $request->billing_total
		]);

		return response()->json([
			'success' => [
				'message' => [ 'Заказ создан' ],
			]
		], 200);
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
			'billing_total' => $request->billing_total,
			'billing_delivery' => $request->billing_delivery,
			'billing_subtotal' => $request->billing_subtotal,
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


	public function changePayment(Request $request)
	{
		$order = Order::find($request->id);
		$order->update([
			'order_payment' => $request->order_payment
		]);
		return redirect()->back();
	}


	public function registerOrder(Request $request, Order $order)
	{
		$client = new Client([
			'userName' => env('SBERBANK_USERNAME'),
			'password' => env('SBERBANK_PASSWORD'),
			'apiUri' => env('SBERBANK_API_URI'),
		]);

		// Required arguments
		$orderId     = $order->order_id.' / '.now();
		$orderAmount = $order->billing_total*100;
		$returnUrl   = env('APP_URL').'/payment-success';

		// You can pass additional parameters like a currency code and etc.
		$params['failUrl']  = env('APP_URL').'/failure';
		//$params['expirationDate'] = now()->addDays(1)->toDateTimeString();
		$params['expirationDate'] = now()->addDays(1)->toIso8601String();

		$result = $client->registerOrder($orderId, $orderAmount, $returnUrl, $params);

		$register_payment = Sberbank::create([
			'payment_id' => $result['orderId'],
			'payment_link' => $result['formUrl'],
			'status' => 'В ожидании',
		])->save();

		$payment = Sberbank::where('payment_id', $result['orderId'])->first();

		$order->payments()->attach($payment);

		return back();

	}

	public function reverseOrder($id, Request $request)
	{
		$client = new Client([
			'userName' => env('SBERBANK_USERNAME'),
			'password' => env('SBERBANK_PASSWORD'),
			'apiUri' => env('SBERBANK_API_URI'),
		]);

		$reverse = $client->reverseOrder($id);

	}

	public function deleteLink($id, Request $request)
	{
		$delete_payment = Sberbank::where('payment_id', $id)->delete();
		return back();

	}


	public function sendLink(Order $order, Request $request)
	{
		$link = $order->payments()->latest()->first();

		if($link) {
			SendSberbankPaymentLink::dispatch($order, $link->payment_link);
			return back()->with('flash', 'Ccылка отправлена на почту '.$order->billing_email);
		}

		return back()->with('flash-error', 'Ccылка не отправлена');

	}


	public function orderStatus($id)
	{
		$client = new Client([
			'userName' => env('SBERBANK_USERNAME'),
			'password' => env('SBERBANK_PASSWORD'),
			'apiUri' => env('SBERBANK_API_URI'),
		]);

		$result = $client->getOrderStatus($id);

		dd($result);
	}
}

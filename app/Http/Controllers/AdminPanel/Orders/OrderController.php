<?php

namespace App\Http\Controllers\AdminPanel\Orders;

use App\Events\NewOrderCreated;
use App\Models\Order;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use JsonException;
use Spatie\Permission\Models\Role;
use App\Filters\Order\DateFromFilter;
use App\Filters\Order\DateToFilter;
use App\Filters\Order\EmailFilter;
use App\Filters\Order\PhoneFilter;
use App\Filters\Order\SurnameFilter;
use Throwable;

class OrderController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->with(['payment', 'manager'])
            ->filter($request, $this->getFilters())
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * @return string[]
     */
    protected function getFilters(): array
    {
        return [
            'surname' => SurnameFilter::class,
            'email'   => EmailFilter::class,
            'phone'   => PhoneFilter::class,
            'from'    => DateFromFilter::class,
            'to'      => DateToFilter::class,
        ];
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        if ($request->user_id) {
            $user_id = $request->user_id;
        } else {
            $user_id = null;
        }

        Order::create([
            'user_id'        => $user_id,
            'order_details'  => $request->details,
            'order_status'   => 'Новый',
            'coupon'         => 0,
            'coupon_details' => null,

            'billing_name'    => $request->user['name'],
            'billing_surname' => $request->user['surname'],
            'billing_phone'   => $request->user['phone'],
            'billing_email'   => $request->user['email'],

            'billing_index'     => $request->address['billing_index'],
            'billing_city'      => $request->address['billing_city'],
            'billing_street'    => $request->address['billing_street'],
            'billing_house'     => $request->address['billing_house'],
            'billing_apartment' => $request->address['billing_apartment'],
            'billing_building'  => $request->address['billing_building'],
            'billing_entrance'  => $request->address['billing_entrance'],
            'billing_floor'     => $request->address['billing_floor'],
            'billing_comment'   => $request->address['billing_comment'],

            'billing_subtotal' => $request->billing_subtotal,
            'billing_delivery' => $request->billing_delivery,
            'billing_total'    => $request->billing_total,
        ]);

        return response()->json([
            'success' => [
                'message' => ['Заказ создан'],
            ],
        ], 200);
    }

    public function assign(Request $request)
    {
        $order   = Order::find((int)$request->id);
        $manager = User::find((int)$request->managerid);

        $order->manager()->associate($manager);
        $order->save();

        return redirect()->back();
    }

    /**
     * @return Factory|View
     */
    public function show(Order $order)
    {
        $details = json_decode($order->order_details);

        $coupon = null;
        if ($order->coupon_details) {
            $coupon = json_decode($order->coupon_details);
        }

        $giftCard = null;
        if ($order->getGiftCardId() !== null) {
            $giftCard = $order->giftCard;
        }

        return view('admin.orders.show', compact(['order', 'details', 'coupon', 'giftCard']));
    }

    /**
     * @return Factory|View
     */
    public function edit(Order $order)
    {
        $details = json_decode($order->order_details);

        return view('admin.orders.edit', compact(['order', 'details']));
    }

    /**
     * @return Factory|View
     */
    public function edit_details(Order $order)
    {
        return view('admin.orders.edit_details', compact(['order']));
    }

    public function update(Request $request)
    {
        $order = Order::find($request->id);

        $order->update([
            'order_details'    => $request->details,
            'billing_total'    => $request->billing_total,
            'billing_delivery' => $request->billing_delivery,
            'billing_subtotal' => $request->billing_subtotal,
        ]);

        return response(['data' => 'Успешно'], 200);
    }

    public function update_details(Request $request, Order $order)
    {
        $order->update([
            'billing_name'      => $request->billing_name,
            'billing_surname'   => $request->billing_surname,
            'billing_phone'     => $request->billing_phone,
            'billing_email'     => $request->billing_email,
            'billing_index'     => $request->billing_index,
            'billing_city'      => $request->billing_city,
            'billing_street'    => $request->billing_street,
            'billing_house'     => $request->billing_house,
            'billing_apartment' => $request->billing_apartment,
            'billing_entrance'  => $request->billing_entrance,
            'billing_floor'     => $request->billing_floor,
            'billing_comment'   => $request->billing_comment,
        ]);

        return redirect()->route('admin.orders.show', $order);
    }


    public function destroy(Request $request)
    {
        $order = Order::find($request->id);

        $order->delete();

        return redirect()->back()->with('flash', 'Заказ ' . $order->order_id . ' удалён');
    }

    public function resendConfirmationEmail(Order $order, Request $request)
    {
        $customer = $order->billing_email;
        $managers = Role::where('name', 'manager')->first()->users()->pluck('email')->toArray();
        $admins   = Role::where('name', 'admin')->first()->users()->pluck('email')->toArray();

        event(new NewOrderCreated($order, $customer, $managers, $admins));

        return redirect()->back()->with('flash', 'Письмо отправлено клиенту!');
    }

    /**
     * @throws JsonException
     */
    public function change(Request $request)
    {
        $order = Order::find($request->id);

        try {
            $order->update([
                'order_status' => $request->order_status,
            ]);

            if ($request->order_status === $order::DELIVERED) {
                $orderId = $order->id;
                $userId = $order->user_id;
                $orderDetails = json_decode($order->order_details, true, 512, JSON_THROW_ON_ERROR);
                $orderProductIds = array_map(function ($line) {
                    return $line['id'];
                }, $orderDetails);

                $data = array_map(function ($productId) use ($userId, $orderId) {
                    return ['user_id' => $userId, 'order_id' => $orderId, 'product_id' => $productId];
                }, $orderProductIds);

                DB::table('user_order_products')->insertOrIgnore(
                    $data
                );
            }
        } catch (Throwable $e) {
            // do something
        }

        return redirect()->back();
    }

    public function changePayment(Request $request)
    {
        $order = Order::find($request->id);
        $order->update([
            'order_payment' => $request->order_payment,
        ]);

        return redirect()->back();
    }
}

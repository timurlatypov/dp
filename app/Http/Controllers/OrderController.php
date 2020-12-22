<?php

namespace App\Http\Controllers;

use App\GoogleAnalytics;
use App\Jobs\SendSberbankPaymentSuccessMessage;
use App\Order;
use App\Coupon;
use App\Events\NewOrderCreated;
use App\Sberbank;
use App\YandexMetrika;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Voronkovich\SberbankAcquiring\Client;
use Voronkovich\SberbankAcquiring\HttpClient\GuzzleAdapter;
use GuzzleHttp\Client as Guzzle;

class OrderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $user_id   = auth()->check() ? $request->user()->id : null;
        $hasCoupon = $request->coupon['coupon'] ? true : false;

        $order = Order::create([
            'user_id'        => $user_id,
            'order_details'  => json_encode($request->cart),
            'order_status'   => 'Новый',
            'coupon'         => $hasCoupon,
            'coupon_details' => json_encode($request->coupon),

            'billing_name'    => $request->user['name'],
            'billing_surname' => $request->user['surname'],
            'billing_phone'   => $request->user['phone'],
            'billing_email'   => $request->user['email'],
            'billing_loyalty' => $request->user['loyalty'],

            'billing_index'     => $request->address['billing_index'],
            'billing_city'      => $request->address['billing_city'],
            'billing_street'    => $request->address['billing_street'],
            'billing_house'     => $request->address['billing_house'],
            'billing_apartment' => $request->address['billing_apartment'],
            'billing_building'  => $request->address['billing_building'],
            'billing_entrance'  => $request->address['billing_entrance'],
            'billing_floor'     => $request->address['billing_floor'],
            'billing_comment'   => $request->address['billing_comment'],

            'billing_subtotal' => $request->billing_total,
            'billing_delivery' => 0,
            'billing_total'    => $request->billing_total,

            'utm_source'   => $request->_sbjs['src'] ?? '',
            'utm_term'     => $request->_sbjs['trm'] ?? '',
            'utm_medium'   => $request->_sbjs['mdm'] ?? '',
            'utm_campaign' => $request->_sbjs['cmp'] ?? '',
            'utm_content'  => $request->_sbjs['cnt'] ?? '',
            'traffic'      => $request->_sbjs['typ'] ?? '',
        ]);

        $customer = $request->user['email'];

        $managers = Role::where('name', 'manager')->first()->users()->pluck('email')->toArray();
        $admins   = Role::where('name', 'admin')->first()->users()->pluck('email')->toArray();

        event(new NewOrderCreated($order, $customer, $managers, $admins));

        $ga = $request->_ga;
        if ($ga) {
            try {
                $ga_exists = GoogleAnalytics::where('ga', $ga)->first();

                if (!$ga_exists) {
                    $ga_save = GoogleAnalytics::create([
                        'ga' => $ga,
                    ])->save();

                    $attach_ga = GoogleAnalytics::where('ga', $ga)->first();
                    $order->ga()->attach($attach_ga);
                }

                $ga_exists = GoogleAnalytics::where('ga', $ga)->first();

                if (!$order->ga->contains($ga_exists)) {
                    $order->ga()->attach($ga_exists);
                }

            } catch (\Throwable $e) {
                //Handle errors
            }
        }

        $ym = $request->_ym;
        if ($ym) {
            try {
                $ym_exists = YandexMetrika::where('ym', $ym)->first();

                if (!$ym_exists) {
                    $ym_save = YandexMetrika::create([
                        'ym' => $ym,
                    ])->save();

                    $attach_ym = YandexMetrika::where('ym', $ym)->first();
                    $order->ym()->attach($attach_ym);
                }

                $ym_exists = YandexMetrika::where('ym', $ym)->first();

                if (!$order->ym->contains($ym_exists)) {
                    $order->ym()->attach($ym_exists);
                }

            } catch (\Throwable $e) {
                //Handle errors
            }
        }


        $coupon = Coupon::where('coupon', $request->coupon['coupon'])->first();
        if ($coupon && !$coupon->reusable) {
            $coupon->update([
                'used' => true,
            ]);
        }

        request()->session()->forget('coupon');

        $cart = \Gloudemans\Shoppingcart\Facades\Cart::destroy();
    }

    public function success(Request $request)
    {
        if ($request->query('orderId')) {
            $id                  = $request->query('orderId');
            $check_order_payment = Sberbank::where('payment_id', $id)->first();

            if ($check_order_payment->status === 'В ожидании') {

                $find_order = $check_order_payment->order;
                $order      = Order::where('id', $find_order[0]->id)->first();

                $check_order_payment->update([
                    'status' => 'Оплачен',
                ]);

                SendSberbankPaymentSuccessMessage::dispatch($order);

                return redirect()->route('page.success')->with('status', 'Заказ успешно оплачен онлайн!');
            }

            abort(404);
        }

        abort(404);
    }
}

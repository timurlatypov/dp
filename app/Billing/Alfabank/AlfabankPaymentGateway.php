<?php

namespace App\Billing\Alfabank;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AlfabankPaymentGateway
{
    private $username;
    private $password;
    private $token;
    private $gateway;
    private $postback;
    private $returnUrl;
    private $failUrl;
    private $sessionTimeoutSecs;

    public function __construct()
    {
        $this->username = config('billing.alfabank.username');
        $this->password = config('billing.alfabank.password');
        $this->token = config('billing.alfabank.token');
        $this->gateway = config('billing.alfabank.gateway');
        $this->postback = config('billing.alfabank.postback');
        $this->returnUrl = config('billing.alfabank.returnUrl');
        $this->failUrl = config('billing.alfabank.failUrl');
        $this->sessionTimeoutSecs = config('billing.alfabank.sessionTimeoutSecs');
    }

    public function registerOrder(Order $order)
    {
        try {
            DB::beginTransaction();

            $data = [];

            if (!empty($this->token)) {
                $data['token'] = $this->token;
            } else {
                $data['userName'] = $this->username;
                $data['password'] = $this->password;
            }

            $data['orderNumber'] = $order->order_id . '/' . now();
            $data['amount'] = (int) $order->billing_total * 100;
            $data['dynamicCallbackUrl'] = $this->postback;
            $data['expirationDate'] = now()->addDays(1)->toIso8601String();
            $data['returnUrl'] = $this->returnUrl;
            $data['failUrl'] = $this->failUrl;
            $data['sessionTimeoutSecs'] = $this->sessionTimeoutSecs;


            $response = Http::asForm()->post($this->gateway . "register.do", $data);
            $data = $response->body();
            $array = json_decode($data, true, 512, JSON_OBJECT_AS_ARRAY);

            $payment = Payment::create([
                'order_id' => $order->order_id_raw,
                'hash' => $array['orderId'],
                'payment_gateway_id' => 1,
                'form_url' => $array['formUrl'],
            ]);

            $order->payment()->save($payment);

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
    }
}

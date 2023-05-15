<?php

namespace App\Http\Controllers\Billing\Gateway;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GatewayController extends Controller
{
    private $username;
    private $password;
    private $gateway;
    private $postback;

    public function __construct()
    {
        $this->username = config('billing.alfabank.username');
        $this->password = config('billing.alfabank.password');
        $this->gateway = config('billing.alfabank.gateway');
        $this->postback = config('billing.alfabank.postback');
    }

    public function register()
    {
        try {
            DB::beginTransaction();

            $data = array(
                'userName' => $this->username,
                'password' => $this->password,
                'orderNumber' => 1230133,
                'amount' => 99000,
                'returnUrl' => 'https://doctorproffi.ru',
                'dynamicCallbackUrl' => $this->postback,
                'description' => 'Order descritption 2'
            );

            $response = Http::asForm()->post($this->gateway. "register.do", $data);
            $data = $response->body();
            $array = json_decode($data, true, 512, JSON_OBJECT_AS_ARRAY);

            $payment = Payment::create([
                'order_id' => 1223,
                'hash' => $array['orderId'],
                'payment_gateway_id' => 1,
                'form_url' => $array['formUrl'],
            ]);

            DB::commit();

        } catch (\Throwable $e) {
            // Log error
            DB::rollBack();

            return response([
                'error' => $e->getMessage(),
            ], 400);
        }

        return response([
            'success' => true,
        ], 200);
    }

    public function decline()
    {
        //
    }
}
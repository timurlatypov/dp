<?php

namespace App\Http\Controllers\Billing\Postback;

use App\Billing\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Jobs\SendPaymentSuccessMessageJob;
use App\Models\Payment;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostbackController extends Controller
{
    public function process(PaymentGateway $gateway, Request $request)
    {
        $queries = [];
        parse_str($request->getQueryString(), $queries);

        $checksum = $queries['checksum'];
        unset($queries['checksum']);


        ksort($queries);
        $flattened = $queries;
        array_walk($flattened, function(&$value, $key) {
            $value = "{$key};{$value}";
        });
        $string = implode(';', $flattened);


        $hmac = hash_hmac ( 'sha256' , $string , '');

        dd(strtoupper($hmac), $checksum);
    }

    public function check(Request $request)
    {
        Log::info('Alfabank PostbackController::check Request Log', [
            'request' => $request->all(),
        ]);

        DB::beginTransaction();
        try {
            if ($request->query('mdOrder')) {
                $hash = $request->query('mdOrder');
                $checkOrderPayment = Payment::where('hash', $hash)->first();

                if ($checkOrderPayment && $checkOrderPayment->status === PaymentStatusEnum::PENDING) {

                    $order = $checkOrderPayment->order;

                    $checkOrderPayment->update([
                        'status' => PaymentStatusEnum::PAID,
                    ]);

                    SendPaymentSuccessMessageJob::dispatch($order);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::info('Alfabank PostbackController::check Error Log', [
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json('OK', 200);
    }
}

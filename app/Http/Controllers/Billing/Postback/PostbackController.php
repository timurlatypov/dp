<?php

namespace App\Http\Controllers\Billing\Postback;

use App\Billing\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Jobs\SendPaymentSuccessMessageJob;
use App\Models\Payment;
use App\Notifications\OrderPaid;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostbackController extends Controller
{
    public function check(Request $request): JsonResponse
    {
        Log::info('Alfabank PostbackController::check Request Log', [
            'request' => $request->all(),
        ]);

        DB::beginTransaction();
        try {
            if ($request->query('mdOrder')) {
                $hash = $request->query('mdOrder');
                $operation = $request->query('operation');
                $status = $request->query('status');

                if ($operation == 'deposited' && $status == '1') {
                    $payment = Payment::where('hash', $hash)->first();
                    if ($payment && $payment->status === PaymentStatusEnum::PENDING) {
                        $order = $payment->order;
                        $payment->update([
                            'status' => PaymentStatusEnum::PAID,
                        ]);

                        $order->notify(new OrderPaid());
                        SendPaymentSuccessMessageJob::dispatch($order);
                    }
                } else {
                    Log::error('Alfabank Payment Error', [
                        'orderNumber' => $request->query('orderNumber'),
                        'mdOrder' => $request->query('mdOrder'),
                        'operation' => $request->query('operation'),
                        'status' => $request->query('status'),
                    ]);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            Log::info('Alfabank PostbackController::check Error Log', [
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json('OK', 200);
    }
}

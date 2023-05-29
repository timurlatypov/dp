<?php

namespace App\Http\Controllers\Billing\Gateway;

use App\Billing\Alfabank\AlfabankPaymentGateway;
use App\Billing\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Jobs\SendPaymentLinkJob;
use App\Jobs\SendPaymentSuccessMessageJob;
use App\Models\Order;
use App\Models\Payment;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function register(Order $order)
    {
        $paymentGateway = new AlfabankPaymentGateway();
        try {
            $paymentGateway->registerOrder($order);

            return back();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function invalidate($hash)
    {
        $payment = Payment::where(['hash' => $hash])->first();

        if ($payment) {
            $payment->delete();
        }

        return back();
    }

    public function sendLink(Order $order, Request $request): RedirectResponse
    {
        /** @var Payment $link */
        $link = $order->payment()->get();

        if ($link) {
            SendPaymentLinkJob::dispatch($order, $link->form_url);

            return back()->with('flash', 'Ccылка отправлена на почту ' . $order->billing_email);
        }

        return back()->with('flash-error', 'Ccылка не отправлена');
    }

    public function success(Request $request)
    {
        if ($request->query('orderId')) {
            $hash = $request->query('orderId');
            $checkOrderPayment = Payment::where('hash', $hash)->first();

            if ($checkOrderPayment && $checkOrderPayment->status === PaymentStatusEnum::PENDING) {

                $order = $checkOrderPayment->order;

                $checkOrderPayment->update([
                    'status' => PaymentStatusEnum::PAID,
                ]);

                SendPaymentSuccessMessageJob::dispatch($order);

                return redirect()->route('page.success')->with('status', 'Заказ успешно оплачен онлайн!');
            }

            abort(404);
        }

        abort(404);
    }

    public function failed()
    {
        return redirect()->route('page.failure');
    }
}
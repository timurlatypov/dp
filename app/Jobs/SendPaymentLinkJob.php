<?php

namespace App\Jobs;

use App\Mail\PaymentLinkEmail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPaymentLinkJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public Order $order;
    public $payment_link;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order, $payment_link)
    {
        $this->order = $order;
        $this->payment_link = $payment_link;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->order->billing_email)
            ->send(new PaymentLinkEmail($this->order, $this->payment_link));
    }
}

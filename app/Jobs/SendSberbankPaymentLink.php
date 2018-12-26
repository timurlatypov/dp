<?php

namespace App\Jobs;

use App\Mail\SberbankPaymentMail;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendSberbankPaymentLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
	public $payment_link;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $payment_link)
    {
        $this->order = $order;
        $this->payment_link = $payment_link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    Mail::to($this->order->billing_email)
		    ->send(new SberbankPaymentMail($this->order, $this->payment_link));
    }
}

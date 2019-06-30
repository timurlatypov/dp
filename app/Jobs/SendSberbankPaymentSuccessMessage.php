<?php

namespace App\Jobs;

use App\Mail\SberbankPaymentSuccessMail;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendSberbankPaymentSuccessMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
	public function handle()
	{
		Mail::to('info@doctorproffi.ru')
			->bcc('timur.latypov@gmail.com')
			->send(new SberbankPaymentSuccessMail($this->order));
	}
}

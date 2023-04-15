<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyManagers extends Mailable
{
    use Queueable, SerializesModels;

	public $order;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
	    $this->order = $order;
        $this->coupon = json_decode($order->coupon_details);
    }
}

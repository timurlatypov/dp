<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

	public $order;
	public $coupon;

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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ваш заказ '.$this->order->order_id)->view('emails.order.notification.customer');
    }
}

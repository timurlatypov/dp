<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SberbankPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $payment_link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $payment_link)
    {
        $this->order = $order;
        $this->payment_link = $payment_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ссылка на онлайн-оплаты заказа '.$this->order->order_id)->view('emails.order.notification.payment');
    }
}

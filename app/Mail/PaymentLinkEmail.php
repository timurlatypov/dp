<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentLinkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public $payment_link;

    public function __construct(Order $order, $payment_link)
    {
        $this->order = $order;
        $this->payment_link = $payment_link;
    }

    public function build(): self
    {
        return $this->subject('Ссылка для онлайн-оплаты заказа '.$this->order->order_id)->view('emails.order.notification.payment');
    }
}

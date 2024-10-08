<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyManagers extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build(): self
    {
        return $this->view('emails.order.notification.manager')->subject('Новый заказ ' . $this->order->order_id);
    }
}

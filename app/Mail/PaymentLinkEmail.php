<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentLinkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
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
}

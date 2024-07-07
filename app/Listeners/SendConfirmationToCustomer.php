<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Mail\NewOrder;
use Illuminate\Support\Facades\Mail;

class SendConfirmationToCustomer
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(NewOrderCreated $event)
    {
        Mail::to($event->customer)
            ->queue(new NewOrder($event->order));
    }
}

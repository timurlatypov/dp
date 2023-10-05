<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Mail\NewOrder;
use Illuminate\Support\Facades\Mail;

class SendConfirmationToCustomer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewOrderCreated  $event
     * @return void
     */
    public function handle(NewOrderCreated $event)
    {
        Mail::to($event->customer)
            ->queue(new NewOrder($event->order));
    }
}

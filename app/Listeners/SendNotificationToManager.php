<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Mail\NotifyManagers;
use Illuminate\Support\Facades\Mail;

class SendNotificationToManager
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  NewOrderCreated  $event
     * @return void
     */
    public function handle(NewOrderCreated $event)
    {
        Mail::to($event->managers)
            ->bcc($event->admins)
            ->queue(new NotifyManagers($event->order));
    }
}

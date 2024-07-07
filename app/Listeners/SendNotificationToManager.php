<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Mail\NotifyManagers;
use Illuminate\Support\Facades\Mail;

class SendNotificationToManager
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
        Mail::to($event->managers)
            ->bcc($event->admins)
            ->queue(new NotifyManagers($event->order));
    }
}

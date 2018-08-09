<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Role;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
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
		    ->queue(new \App\Mail\NotifyManagers($event));
    }
}

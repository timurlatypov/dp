<?php

namespace App\Listeners\Review;

use App\Events\NewReviewCreated;
use App\Mail\Review\SendNewReviewNotification;
use Illuminate\Support\Facades\Mail;

class NewReviewCreatedListener
{
    /**
     * Handle the event.
     *
     * @param  NewReviewCreated  $event
     * @return void
     */
    public function handle(NewReviewCreated $event)
    {
        Mail::to($event->managers)
            ->bcc($event->admins)
            ->queue(new SendNewReviewNotification($event->review));
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed  $notifiable
     *
     * @return array
     *
     * @psalm-return array<never, never>
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}

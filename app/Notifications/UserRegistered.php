<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Успешная регистрация!')
            ->line('Вы успешно зарегистрировались в нашем интернет-магазине ДокторПроффи.ру!')
            ->action('В магазин', url('/'));
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed  $notifiable
     *
     * @return array
     **/
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}

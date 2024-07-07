<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
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
     **/
    public function toArray($notifiable): array
    {
        return [
        ];
    }
}

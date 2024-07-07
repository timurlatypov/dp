<?php

namespace App\Notifications;

use App\Enum\Notification\MessageThread;
use App\Models\Order;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class OrderCreated extends Notification
{
    public function via($notifiable)
    {
        return ['telegram'];
    }

    public function toTelegram(Order $notifiable)
    {
        return TelegramMessage::create()
            ->to(config('services.telegram-bot-api.chat_id'))
            ->options([
                'message_thread_id' => MessageThread::ORDERS,
            ])
            ->line('Новый заказ: [' . $notifiable->order_id . '](https://doctorproffi.ru/admin-panel/orders/' . $notifiable->getOrderIdRawAttribute() . '/show)')
            ->line('Дата: ' . $notifiable->created_at->format('Y-m-d H:i:s'));
    }
}

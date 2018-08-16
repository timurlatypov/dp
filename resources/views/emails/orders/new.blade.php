@component('mail::message')
Добрый день, {{ $order->billing_name }}
<br><br>
Мы получили Ваш заказ <b>{{ $order->order_id }}</b> от {{ $order->created_at->format('d.m.Y') }}
<br>
Мы обязательно свяжемся с Вами в ближайшее время по номеру: <b>{{ $order->billing_phone }}</b>.
<br><br>
С уважением,<br>
Команда {{ config('app.name') }}
@endcomponent

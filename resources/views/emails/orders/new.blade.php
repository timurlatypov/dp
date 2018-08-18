@component('mail::message')
Здравствуйте, {{ $order->billing_name }}!
<br><br>
Мы получили Ваш заказ <b>{{ $order->order_id }}</b> от {{ $order->created_at->format('d.m.Y') }}.
<br>
Мы обязательно свяжемся с Вами в ближайшее время по номеру: <b><nobr>{{ $order->billing_phone }}</nobr></b>.
<br><br>
С уважением,<br>
Команда {{ config('app.name') }}
@endcomponent

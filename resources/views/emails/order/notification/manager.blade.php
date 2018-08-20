<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
<h4>Новый заказ: {{ $order->order_id }}</h4>
Клиент: {{ $order->billing_name }} {{ $order->billing_surname }}<br><br>
{{ $order->created_at->format('d.m.Y') }}
</body>
</html>
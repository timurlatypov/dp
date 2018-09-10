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
<h4>Нужна консультация косметолога<br>Перезвоните мне!</h4>
<p>
    <b>Имя:</b> {{ $request->name }}<br>
    <b>Телефон:</b> {{ $request->phone }}<br>
    <b>Комментарий:</b> {{ $request->comment }}</p>
</body>
</html>
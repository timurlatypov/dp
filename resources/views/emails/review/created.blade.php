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
<h4>Создан новый отзыв</h4>
<p>
    <b>ID:</b> {{ $review->id }}<br>
    <b>Оценка:</b> {{ $review->stars }}<br>
    <b>Отзыв:</b> {{ $review->review }}
</p>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ошибка при оплате</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .content {
            text-align: center;
        }

        .title {
            padding: 20px 20px 0px 20px;
            color: darkred;
        }
        .brand-logo svg {
            width: 180px;
            fill: #ca9f5e;
        }
        a {
            color: #ca9f5e;
        }
        h4 {
            font-size: 26px;
        }
        p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div>
            <div class="brand-logo">@include('layouts.partials._logo')</div>
            <i class="fas fa-sm fa-thumbs-up"></i>
            <h4 class="title">Оплата заказа не прошла!</h4>
            <p>Что-то пошло не так, обратитесь к нашему менеджеру за помощью.</p>
            <br>
            <a href="tel:84953801141"><b>8 (495) 380-11-41</b></a>
            <br><br>
            <p>вернуться в магазин:</p>
            <a href="{{ route('landing-page') }}">www.doctorproffi.ru</a>
        </div>
    </div>
</div>
</body>
</html>

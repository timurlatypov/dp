
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Успешная оплата</title>

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
            padding: 20px;
            color: green;
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
            <h4 class="title">Ваш заказ успешно оплачен!</h4>
            <p>вернуться в магазин:</p>
            <a href="{{ route('landing-page') }}">www.doctorproffi.ru</a>
        </div>
    </div>
</div>
</body>
</html>

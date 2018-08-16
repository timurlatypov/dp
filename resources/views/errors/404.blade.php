
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 - Страница не найдена</title>

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
            font-size: 36px;
            padding: 20px;
        }
        .brand-logo svg {
            width: 180px;
            fill: #ca9f5e;
        }
        a {
            color: #ca9f5e;
        }
        h4 {
            padding: 20px 0;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div>
                <div class="brand-logo">@include('layouts.partials._logo')</div>
                <h4>404 - Страница не найдена</h4>
                <a href="{{ route('landing-page') }}">www.doctorproffi.ru</a>
        </div>
    </div>
</div>
</body>
</html>

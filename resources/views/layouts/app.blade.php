<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head')
</head>
<body>
    <div id="app">
        <flash message="{{ session('flash') }}" ></flash>
        @include('layouts.partials._header')
        @include('layouts.partials._nav')

        <div class="container-fluid p-0 h-100">
            <div class="row h-100 m-0">

                <div class="col-12 align-self-center p-0">
                    @yield('carousel')
                    @yield('banner')
                    @yield('content')
                    @yield('infoblock')
                    @yield('brands')
                    @yield('about')
                    @yield('blog')
                </div>

                <div class="col-12 align-self-end p-0">
                    @include('layouts.partials._footer')
                </div>

            </div>
        </div>

    </div>
</body>
</html>

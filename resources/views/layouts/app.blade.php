<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head')
</head>
<body>
    @include('layouts.partials._header')
    <div id="app">
        @include('layouts.partials._nav')
        <flash message="{{ session('flash') }}" ></flash>
        <div class="container-fluid p-0 h-100">
            <div class="row h-100 m-0">
                <div class="col-12 align-self-start p-0">
                    @yield('carousel')
                    @yield('banner')
                    @yield('seasonal')
                    @yield('bestsellers')
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

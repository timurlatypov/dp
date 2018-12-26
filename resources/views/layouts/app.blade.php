<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    @stack('meta')
    @include('layouts.partials._head')
    @stack('share')
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
</head>
<body>
    <div id="app">
        <div class="snowflakes" aria-hidden="true">
                <div class="snowflake">
                    ❅
                </div>
                <div class="snowflake">
                    ❅
                </div>
                <div class="snowflake">
                    ❆
                </div>
                <div class="snowflake">
                    ❄
                </div>
                <div class="snowflake">
                    ❅
                </div>
                <div class="snowflake">
                    ❆
                </div>
                <div class="snowflake">
                    ❄
                </div>
                <div class="snowflake">
                    ❅
                </div>
                <div class="snowflake">
                    ❆
                </div>
                <div class="snowflake">
                    ❄
                </div>
            </div>
        @include('layouts.partials._header')
        @include('layouts.partials._nav')
        @include('layouts.partials._mobile-search')
        @include('layouts.partials._callback')
        <flash message="{{ session('flash') }}" ></flash>
        <flash message="{{ session('flash-error') }}" ></flash>
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 h-100 align-self-start p-0">
                    @yield('carousel')
                    @stack('carousel')
                    @yield('banner')
                    @yield('seasonal')
                    @yield('bestsellers')
                    @yield('content')
                    @yield('brands')
                    @yield('infoblock')
                    @yield('about')
                    {{--@yield('blog')--}}
                </div>
                <div class="col-12 align-self-end p-0">
                    @include('layouts.partials._footer')
                </div>
            </div>
        </div>
        <cart-modal payload="{{ session('cartModal') }}" ></cart-modal>
    </div>
    @include('layouts.partials._metrika')
    @include('layouts.partials._ga')
    @include('layouts.partials._facebook_pixel')
    @include('layouts.partials._callback_button')
</body>
</html>

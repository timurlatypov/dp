<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="facebook-domain-verification" content="lteht5c11k3xsym3kk0qm00izgq7zv" />
    @include('layouts.partials._gtm')
    @include('layouts.partials._head')
    @stack('meta')
    @stack('share')
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    @stack('js')
</head>
<body>
@include('layouts.partials._gtm_body')
<div id="app">
    @include('layouts.partials._header')
    @include('layouts.partials._mobile-search')
    @include('layouts.partials._callback')
    @include('layouts.partials.auth._register')
    <flash message="{{ session('flash') }}"></flash>
    <flash message="{{ session('flash-error') }}"></flash>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 h-100 align-self-start p-0">
                @yield('carousel')
                @stack('carousel')
                @yield('banner')
                @yield('promotions')
                @yield('infoblock')
                @yield('brands')
                @yield('seasonal')
                @yield('bestsellers')
                @yield('content')
            </div>
            <div class="col-12 align-self-end p-0">
                @include('layouts.partials._footer')
            </div>
        </div>
    </div>
    <cart-modal payload="{{ session('cartModal') }}"></cart-modal>
</div>
@include('layouts.partials._callback_button')
</body>
</html>

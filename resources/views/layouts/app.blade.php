<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    @stack('meta')
    @include('layouts.partials._head')
    @stack('share')
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2151538838446479');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=2151538838446479&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
</head>
<body>
    <div id="app">
        @include('layouts.partials._header')
        @include('layouts.partials._nav')
        @include('layouts.partials._mobile-search')
        @include('layouts.partials._callback')
        <flash message="{{ session('flash') }}" ></flash>
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
    @include('layouts.partials._callback_button')
</body>
</html>

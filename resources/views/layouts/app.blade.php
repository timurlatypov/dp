<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.partials._head')
</head>
<body>
    <div id="app">
        @include('layouts.partials._header')
        @include('layouts.partials._nav')

        @include('layouts.partials._carousel')

        <main class="py-4">
            @yield('content')
        </main>

        <flash message="{{ session('flash') }}"></flash>

        @yield('infoblock')

        @yield('brands')

        @yield('about')

        @yield('blog')

        @include('layouts.partials._footer')
    </div>
</body>
</html>

@extends('layouts.app')

@push('meta')<title>Купить профессиональную косметику в Москве в интернет-магазине ДокторПроффи.ру</title>
    <meta name="description" content="Только 100% оригинальная сертифицированная профессиональная косметика, созданная ведущими американскими, бразильскими и итальянскими учеными с учетом самых высоких стандартов качества и безопасности. Широкий ассортимент позволяет подобрать уход, отвечающий индивидуальным потребностям любого покупателя. Опытные консультанты профессионально помогут Вам сделать правильный выбор для себя и близких.">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="Интернет-магазин профессиональной косметики в Москве - ДокторПроффи.ру"/>
@endpush

@section('carousel')
    @include('layouts.partials._carousel')
@endsection

@section('content')
    @include('layouts.partials._bestsellers')
@endsection

@section('brands')
    @include('layouts.partials._brands')
@endsection

@section('infoblock')
    @include('layouts.partials._infoblock')
@endsection

@section('about')
    @include('layouts.partials._about')
@endsection

@section('blog')
    @include('layouts.partials._blog')
@endsection
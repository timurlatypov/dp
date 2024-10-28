@extends('layouts.app')

@push('meta')<title>Купить профессиональную косметику в интернет-магазине ДокторПроффи.ру</title>
    <meta name="description" content="Только 100% оригинальная сертифицированная профессиональная косметика, созданная ведущими американскими, бразильскими и итальянскими учеными с учетом самых высоких стандартов качества и безопасности.">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="Интернет-магазин профессиональной косметики - ДокторПроффи.ру"/>
@endpush

@section('carousel')
    @include('layouts.partials._carousel')
@endsection

@section('promotions')
    @include('layouts.partials._promotions')
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

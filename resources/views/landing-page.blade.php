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

@section('content')
    <noindex>@include('layouts.partials._bestsellers')</noindex>
@endsection

@section('brands')
    <noindex>@include('layouts.partials._brands')</noindex>
@endsection

@section('infoblock')
    <noindex>@include('layouts.partials._infoblock')</noindex>
@endsection

@section('about')
    @include('layouts.partials._about')
@endsection

@section('blog')
    @include('layouts.partials._blog')
@endsection
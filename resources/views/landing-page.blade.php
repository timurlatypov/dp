@extends('layouts.app')

@push('meta')
    <title>Купить профессиональную косметику в Москве в интернет-магазине ДокторПроффи.ру</title>
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
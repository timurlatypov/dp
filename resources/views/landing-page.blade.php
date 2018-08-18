@extends('layouts.app')

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
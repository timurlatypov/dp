@extends('layouts.app')

@section('content')
    @include('layouts.partials._seasonal')
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
@extends('layouts.app')

@push('meta')
    <title>{{ $title }} - интернет-магазин ДокторПроффи.ру</title>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content=""/>
@endpush

@section('content')
    <div class="container {{ $translate }}">
        <div class="row">
            <div class="col-12 pt-3">

                <div class="card">
                    <div class="card-header text-center mb-4 card-header-doctorproffi">
                        <h4 class="card-title mb-1 mt-0">{{ $title }}</h4>
                    </div>
                    <div class="card-body p-0">

                        {{ $content }}

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
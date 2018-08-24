@extends('layouts.app')

@push('meta')
    <title>Косметика {{ $brand->name }} - купить в интернет-магазине ДокторПроффи.ру</title>
    <meta name="description" content="{{ $brand->meta_description }}">
    <meta name="keywords" content="{{ $brand->meta_keywords }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="Вся косметика {{ $brand->name }} - Купить в интернет-магазине ДокторПроффи.ру"/>
    <meta property="og:description" content="{{ $brand->meta_description }}"/>
    <meta property="og:image" content="{{ url('/storage/brands/'.$brand->image_path) }}"/>
@endpush

@section('banner')
    @include('layouts.partials.banner.banner')
@endsection

@section('content')
    <div class="container translate-top-30">
        <div class="row">
            <div class="col-12 pt-3">


                <div class="card">

                    <div class="card-header card-header-doctorproffi text-center mb-4">
                        <h4 class="card-title mb-1 mt-0">{{ $brand->name }}</h4>
                    </div>

                    <div class="card-body p-0">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-3 px-3">
                                    @if(count($brand->lines))
                                        <h4 class="title mt-0 mb-3"><nobr>Линии бренда</nobr></h4>
                                        <ul class="list-group py-0">
                                            @foreach($brand->lines as $line)
                                                <li class="list-group-item py-0">
                                                    <a class="btn btn-sm text-dark text-left {{ url()->current() === route('show.brand.line.products', [$brand, $line]) ? 'btn-warning' : 'btn-white' }}" href="{{ route('show.brand.line.products', [$brand, $line]) }}"><b>{{ $line->name }}</b><div class="ripple-container"></div></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        @include('layouts.partials._in_product_nav')
                                    @endif

                                </div>
                                <div class="col-12 col-sm-9 col-md-9 d-flex flex-wrap card-col-9">
                                    @each('layouts.partials.product.card', $products, 'product')
                                </div>
                            </div>

                            @if ($products->hasMorePages())
                                @include('layouts.partials._pagination')
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
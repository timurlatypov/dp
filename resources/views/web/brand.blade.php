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
    <div style="
            position: relative;
            width: 100%;
            height: 300px;
            background-image: url('/storage/banners/{{ $brand->brand_image_path }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            text-align: right;
            ">

        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 text-right align-self-center">
                    <div class="brand-logo-banner"><img src="/storage/brands/{{ $brand->image_path }}" alt="Логотип {{ $brand->name }}"></div>
                    <h6 class="py-3">{{ $brand->title }}</h6>
                </div>
            </div>
        </div>

    </div>
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
                        <div class="col-12 col-sm-3">
                            <h5 class="title">Линии бренда</h5>
                            @if(count($brand->lines))

                                <ul class="nav flex-column">
                                    @foreach($brand->lines as $line)
                                    <li class="nav-item">
                                        <a class="btn btn-warning text-left" href="{{ route('show.brand.line.products', [$brand, $line]) }}">{{ $line->name }}<div class="ripple-container"></div></a>
                                    </li>
                                    @endforeach
                                </ul>

                            @endif
                        </div>
                        <div class="col-12 col-sm-9 col-md-9 d-flex flex-wrap card-col-9">
                            @each('layouts.partials.product.card', $products, 'product')
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <div class="row justify-content-center">
                                <div class="mx-auto pb-4 text-center">
                                    <h4 class="title">Страницы</h4>
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

    </div>

            </div>
        </div>
    </div>
@endsection
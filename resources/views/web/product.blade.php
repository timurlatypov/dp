@extends('layouts.app')
@push('meta')

<title>Купить {{ $product->title_eng }} за {{ $product->definePriceToShow() }}&#x20BD; - {{ $brand->name }} {{ $product->title_rus }} в ДокторПроффи.ру</title>
<meta name="description" content="{{ $product->meta_description }}">
<meta name="keywords" content="{{ $product->meta_keywords }}">
<meta name="geo.region" content="RU" />
<meta name="geo.placename" content="Москва" />
<meta name="geo.position" content="55.7522200, 37.6155600" />
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:type" content="article"/>
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:title" content="{{ $brand->name }} {{ $product->title_eng }} - {{ $product->title_rus }}"/>
<meta property="og:description" content="{{ $product->meta_description }}"/>
<meta property="og:image" content="{{ url('/storage/products/thumbs/'.$product->thumb_path) }}"/>
<meta property="article:author" content="https://www.facebook.com/DoctorProffi.ru/"/>
<meta property="og:locale" content="ru_RU"/>

@endpush

@section('banner')
    <div style="
            position: relative;
            width: 100%;
            height: 400px;
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
    <div class="container" style="transform: translate3d(0, -70px,0);">
        <div class="row">
            <div class="col-12 pt-3">


                <div class="card">

                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <h5 class="title">Для лица</h5>
                                    <p></p>
                                </div>

                                <div class="col-12 col-sm-9">

                                   <div class="container-fluid">
                                        <div class="row align-content-center">
                                            <div class="col-12 col-sm-6 col-md-7 px-sm-0 py-sm-2">
                                                <img src="/storage/products/image/{{$product->image_path}}" width="100%" alt="{{ $brand->name }} {{ $product->title_eng }} - {{ $product->title_rus }} | DoctorProffi.ru">
                                                <div>100% гарантия подлинности</div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-5 p-5 px-sm-0 py-sm-2 align-self-center">
                                                <div class="brand-logo"><img src="/storage/brands/{{ $brand->image_path }}" alt="Логотип {{ $brand->name }}"></div>
                                                <h1 class="title mb-1 mt-4">{{ $product->title_eng }}</h1>
                                                <span>{{ $product->title_rus }}</span><br>
                                                @if($product->discount)
                                                    <span class="badge badge-pill badge-danger font-weight-bold">-{{ $product->discount }}%</span>
                                                @endif
                                                @if($product->ph)<small class="font-weight-bold">pH: {{ $product->ph }}</small>@endif

                                                @if($product->discount)
                                                    <div class="pt-3">
                                                        <h4 class="title my-0 opacity-50"><strike>{{ $product->price }} <i class="fas fa-ruble-sign fa-sm"></i></strike></h4>
                                                        <h4 class="title my-0 text-danger">{{ $product->definePriceToShow() }} <i class="fas fa-ruble-sign fa-sm"></i></h4>
                                                    </div>
                                                @else
                                                    <h4 class="title my-0 text-success py-3">{{ $product->definePriceToShow() }} <i class="fas fa-ruble-sign fa-sm"></i></h4>
                                                @endif
                                                <add-button endpoint="{{ route('add.product.to.cart') }}" :model="{{ $product }}" :price_to_show="{{ $product->definePriceToShow() }}"></add-button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 p-5">
                                                <h4 class="title">Описание</h4>
                                                <p>{!! $product->description_full !!}</p>
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
    </div>
@endsection
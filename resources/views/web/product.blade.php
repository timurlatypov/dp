@extends('layouts.app')

@section('banner')
    <div style="
            position: relative;
            width: 100%;
            height: 300px;
            background-image: url('/storage/banners/{{ $brand->image_path }}');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            "></div>
@endsection

@section('content')
    <div class="container" style="transform: translate3d(0, -70px,0);">
        <div class="row">
            <div class="col-12 pt-3">


                <div class="card">
                    <div class="text-center">
                        <h3 class="title mb-1 mt-4"></h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <h5 class="title">Каталог</h5>
                                </div>

                                <div class="col-12 col-sm-9">

                                   <div class="container-fluid">
                                        <div class="row align-content-center">
                                            <div class="col-12 col-md-6">
                                                <img src="/storage/products/image/{{$product->image_path}}" width="100%" alt="{{ $brand->name }} {{ $product->title_eng }} - {{ $product->title_rus }} | DoctorProffi.ru">
                                            </div>
                                            <div class="col-12 col-md-6 align-self-center">
                                                <div class="brand-logo"><img src="/storage/brands/{{ $brand->image_path }}" alt="Логотип {{ $brand->name }}"></div>
                                                <h1 class="title mb-1 mt-4">{{ $product->title_eng }}</h1>
                                                <span>{{ $product->title_rus }}</span><br>
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
@extends('layouts.app')

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
    <div class="container" style="transform: translate3d(0, -60px,0);">
        <div class="row">
            <div class="col-12 pt-3">


            <div class="card">

            <div class="card-header card-header-doctorproffi text-center mb-4">
                <h4 class="card-title mb-1 mt-0">Все продукты {{ $brand->name }}</h4>
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
                        <div class="col-9 align-content-center">
                            <div class="mx-auto p-4 text-center">
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
@endsection
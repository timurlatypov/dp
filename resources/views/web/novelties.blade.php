@extends('layouts.app')

@section('banner')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 pt-3">


                <div class="card">

                    <div class="card-header card-header-success text-center">
                        <h4 class="card-title mb-1 mt-0">Новинки</h4>
                    </div>

                    <div class="card-body">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-3 col-md-3 px-0">
                                    <h5 class="title">Линии бренда</h5>
                                    {{--@if(count($brand->lines))--}}

                                    {{--<ul class="nav flex-column">--}}
                                    {{--@foreach($brand->lines as $line)--}}
                                    {{--<li class="nav-item">--}}
                                    {{--<a class="btn btn-warning text-left" href="{{ route('show.brand.line.products', [$brand, $line]) }}">{{ $line->name }}<div class="ripple-container"></div></a>--}}
                                    {{--</li>--}}
                                    {{--@endforeach--}}
                                    {{--</ul>--}}

                                    {{--@endif--}}
                                </div>

                                <div class="col-12 col-sm-9 col-md-9 d-flex flex-wrap justify-content-start">

                                    @foreach($products as $product)
                                        <div class="card card-product p-2 mr-4">
                                            <div>
                                                <a href="#"><img class="card-img-top" src="/storage/products/thumb/{{$product->thumb_path}}" alt=""></a>
                                                <div class="position-absolute top-0 p-2">
                                                    <h6 class="text-muted my-1">{{ $product->brand->name }}</h6>
                                                    @if($product->ph)<small class="font-weight-bold">pH: {{ $product->ph }}</small>@endif
                                                </div>
                                                <div class="position-absolute top-0 right-0 pr-1">
                                                    @if(auth()->check())<add-favorite endpoint="{{ route('attach.product.to.favorite', $product) }}"></add-favorite>@endif
                                                </div>
                                            </div>

                                            <div class="card-body w-100">
                                                <h4 class="title my-0"><a href="#" class="hover-underlined">{{$product->title_eng}}</a></h4>
                                                <p class="mt-0 mb-3 text-muted">{{$product->title_rus}}</p>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-inline-flex">
                                                        {{--<h4 class="title my-0 opacity-50"><strike>2630 <i class="fas fa-ruble-sign fa-sm"></i></strike></h4>&nbsp;&nbsp;<h4 class="title my-0 text-danger">2100 <i class="fas fa-ruble-sign fa-sm"></i></h4>--}}
                                                        <h4 class="title my-0 {{ $product->discount ? ' text-danger' : 'text-success' }}">{{ $product->definePriceToShow() }} <i class="fas fa-ruble-sign fa-sm"></i></h4>
                                                    </div>

                                                    <add-button endpoint="{{ route('add.product.to.cart') }}" :model="{{ $product }}" :price_to_show="{{ $product->definePriceToShow() }}"></add-button>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mx-auto p-4 text-center">
                                        {{--<h4 class="title">Страницы</h4>--}}
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
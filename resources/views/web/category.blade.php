@extends('layouts.app')

@section('banner')
    <div style="
    position: relative;
    width: 100%;
    height: 300px;
    background-image: url('/storage/banners/{{ $categories->image_path }}');
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
                        <h3 class="title mb-1 mt-4">{{ $categories->name }}</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <h5 class="title">Линии бренда</h5>
                                </div>

                                <div class="col-12 col-sm-9 d-flex flex-wrap flex-row card-col-9">

                                    @each('layouts.partials.product.card', $products, 'product')

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
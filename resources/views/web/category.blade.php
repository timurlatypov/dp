@extends('layouts.app')

@push('meta')
    <title>@if(isset($subcategory)){{ $subcategory->body }}@else{{ $categories->body }}@endif</title>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="@if(isset($subcategory)){{ $subcategory->name }}@else{{ $categories->title }}@endif"/>
@endpush

@section('banner')
    <div style="
    position: relative;
    width: 100%;
    height: 300px;
    background-image: url('/storage/banners/@if(isset($subcategory)){{$subcategory->image_path}}@else{{ $categories->image_path }}@endif');
    background-position: center;
    background-repeat: no-repeat;
            background-size: cover;
    "></div>
@endsection

@section('content')
    <div class="container translate-top-30">
        <div class="row">
            <div class="col-12 pt-3">


                <div class="card">

                    <div class="text-center">
                        <h3 class="title mb-4 mt-4">{{ $categories->title }}</h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    <h5 class="title"></h5>
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
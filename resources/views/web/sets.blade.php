@extends('layouts.app')

@push('meta')
    <title>Наборы</title>
@endpush

@if (isset($categories->image_path) || isset($subcategory->image_path))

@section('banner')
    @include('layouts.partials.banner.banner')
@endsection
@else
@section('carousel')
    @include('layouts.partials._carousel')
@endsection
@endif

@section('content')
    <div class="container translate-top-30">
        <div class="row">
            <div class="col-12 pt-3">
                <div class="card">
                    <div class="card-header text-center mb-4 card-header-info">
                        <h4 class="card-title mb-1 mt-0">{{ $brand->name }}</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-3 hidden-sm">
                                    @include('layouts.partials._in_product_nav')
                                </div>
                                <div class="col-12 col-sm-9 col-md-9">
                                    @if ( strlen($products->links()) )
                                        <div class="d-flex w-100 justify-content-center">
                                            <div class="">
                                                {{ $products->links() }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class=" d-flex flex-wrap card-col-9 align-self-start">
                                        @each('layouts.partials.product.card', $products, 'product')
                                    </div>
                                </div>
                            </div>
                            @include('layouts.partials._pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
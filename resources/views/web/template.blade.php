@extends('layouts.app')

@push('meta')
    <title>@if(isset($subcategory)){{ $subcategory->seo_title }}@else{{ $categories->seo_title }}@endif</title>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="@if(isset($subcategory)){{ $subcategory->name }}@else{{ $categories->title }}@endif"/>
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
                    <div class="card-header text-center mb-4 @isset($categories->style){{$categories->style}}@endisset">
                        <h4 class="card-title mb-1 mt-0">{{ $categories->title }}</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-4 col-md-3 hidden-sm">
                                    @include('layouts.partials._in_product_nav')
                                </div>
                                <div class="col-12 col-sm-9 d-flex flex-wrap flex-row card-col-9">
                                    @each('layouts.partials.product.card', $products, 'product')
                                </div>
                            </div>
                            @if ( strlen($products->links()) )
                                @include('layouts.partials._pagination')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
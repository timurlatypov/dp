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

                    <div class="card-header card-header-doctorproffi text-center mb-4">
                        <h4 class="card-title mb-1 mt-0">{{ $categories->title }}@isset($subcategory) / {{$subcategory->title}}@endisset</h4>
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

                            {{--@if(isset($categories->body) || isset($subcategory->body))--}}
                            {{--<div class="row p-4">--}}
                                {{--<div class="col-12 col-sm-3"></div>--}}
                                {{--<div class="col-12 col-sm-9">--}}
                                    {{--<h4 class="title">@if(isset($subcategory->title)){{$subcategory->title}}@else{{$categories->title}}@endif</h4>--}}
                                    {{--<p class="text-justify">@if(isset($subcategory->body)){!! $subcategory->body !!}@else{{$categories->body}}@endif</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--@endif--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
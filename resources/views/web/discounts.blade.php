@extends('layouts.app')

@push('meta')
    <title>Скидки на профессиональную косметику в интернет-магазине ДокторПроффи.ру</title>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="Скидки на профессиональную косметику в интернет-магазине ДокторПроффи.ру "/>
@endpush

@section('carousel')
    @include('layouts.partials._carousel')
@endsection

@section('content')
    <div class="container translate-top-30">
        <div class="row">
            <div class="col-12 pt-3">
                <div class="card">
                    <div class="card-header text-center mb-4 card-header-danger">
                        <h4 class="card-title mb-1 mt-0">Продукты со скидками!</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-3">
                                    @include('layouts.partials._in_product_nav')
                                </div>
                                <div class="col-12 col-sm-9 d-flex flex-wrap flex-row card-col-9">
                                    @each('layouts.partials.product.card', $products, 'product')
                                </div>
                            </div>
                            @if ($products->hasMorePages())
                                @include('layouts.partials._pagination')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('banner')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 pt-3">


                <div class="card">

                    <div class="card-header card-header-danger text-center">
                        <h4 class="card-title mb-1 mt-0">Популярные продукты</h4>
                    </div>

                    <div class="card-body p-0">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-3 col-md-3 px-0">
                                    <h5 class="title">Линии бренда</h5>
                                </div>

                                <div class="col-12 col-sm-9 col-md-9 d-flex flex-wrap card-col-9">
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
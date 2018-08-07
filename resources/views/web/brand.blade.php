@extends('layouts.app')

@section('banner')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 pt-3">


            <div class="card">

            <div class="card-header card-header-doctorproffi text-center">
                <h4 class="card-title mb-1 mt-0">Все продукты {{ $brand->name }}</h4>
            </div>

            <div class="card-body">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-3 col-md-3 px-0">
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

                        <div class="col-12 col-sm-9 col-md-9 d-flex flex-wrap justify-content-start">
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
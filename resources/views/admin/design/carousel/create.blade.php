@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="align-self-center"><h4 class="title my-0"><a href="{{ route('admin.design.index') }}">Design</a> / Carousel Creator</h4></div>
                        </div>

                        <carousel-creator store_banner_endpoint="{{ route('admin.design.carousel.store') }}"
                                          store_image_endpoint="{{ route('api.store.product.image') }}"
                                          store_path="carousel"></carousel-creator>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
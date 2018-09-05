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

                        <carousel-creator endpoint="{{ route('admin.design.carousel.update') }}"></carousel-creator>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="align-self-center"><h4 class="title my-0"><a href="{{ route('admin.design.index') }}">Design</a> / Carousel Editor</h4></div>
                            <div class="ml-auto align-self-center"><a class="btn btn-primary" href="{{ route('admin.design.carousel.create') }}">New banner</a></div>
                        </div>

                        <carousel-editor :data="{{$carousels}}" update_endpoint="{{ route('admin.design.carousel.update') }}" live_toggle_endpoint="{{ route('api.carousel.live.toggle') }}"></carousel-editor>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
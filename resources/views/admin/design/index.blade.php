@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="title">Design</h4>

                        <a href="{{ route('admin.design.carousel') }}">Carousel</a>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
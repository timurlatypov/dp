@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="title">Подкатегория: {{ $subcategory->name }}</h4>

                        <associate-products endpoint="{{route('admin.categories.subcategory.associate.products', [$categories, $subcategory])}}" :object="{{ $subcategory }}" :items="@if($subcategory->products){{ $subcategory->products }}@else null @endif"></associate-products>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
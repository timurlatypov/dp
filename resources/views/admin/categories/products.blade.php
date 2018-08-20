@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">

            <h4 class="title">Категория: {{ $category->name }}</h4>

            <associate-products endpoint="{{route('admin.categories.associate.products', $category)}}" :object="{{ $category }}" :items="@if($category->products){{ $category->products }}@else null @endif"></associate-products>

        </div>
    </div>
@endsection
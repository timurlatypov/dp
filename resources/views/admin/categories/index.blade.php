@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="w-25">Категории</th>
                            <th class="w-25">Подкатегории</th>
                            <th class="text-right">Действие</th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td style="vertical-align: top;">{{ $category->id }}</td>
                                    <td style="vertical-align: top;">{{ $category->name }} @if($category->subcategories)({{ count($category->subcategories) }})@endif</td>
                                    <td>
                                        @if($category->subcategories)
                                        <order-subcategories category_slug="{{ $category->slug }}" :data="{{ $category->subcategories }}"></order-subcategories>
                                        @endif
                                    </td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('admin.categories.products', $category) }}" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">assignment</i>
                                        </a>
                                        <button type="button" rel="tooltip" class="btn btn-danger">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">


                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="w-25">Название</th>
                            <th class="w-25">Бренд</th>
                            <th>Цена</th>
                            <th>Скидка</th>
                            <th>Новинка</th>
                            <th>Сезонный</th>
                            <th>Бестселлер</th>
                            <th>На сайте</th>
                            <th class="text-right">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                        <tr>
                            <td class="text-center">{{ $product->id }}</td>
                            <td>{{ $product->title_eng }}</td>
                            <td>{{ $product->brand->name }}</td>

                            <td>
                                <input-field value="{{ $product->price }}" endpoint="{{ route('api.product.price.update') }}" product_id="{{ $product->id }}" fontawesome="fa fa-ruble-sign fa-sm" placeholder="Цена" id="inputPrice"></input-field>
                            </td>

                            <td>
                                <input-field value="{{ $product->discount }}" endpoint="{{ route('api.product.discount.update') }}" product_id="{{ $product->id }}" fontawesome="fa fa-percentage" placeholder="Скидка" id="inputDiscount"></input-field>
                            </td>

                            <td>
                                <toggle-switch toggle="{{ $product->novelty }}" endpoint="{{ route('api.novelty.toggle') }}" product_id="{{ $product->id }}"></toggle-switch>
                            </td>

                            <td>
                                <toggle-switch toggle="{{ $product->seasonal }}" endpoint="{{ route('api.seasonal.toggle') }}" product_id="{{ $product->id }}"></toggle-switch>
                            </td>

                            <td>
                                <toggle-switch toggle="{{ $product->bestseller }}" endpoint="{{ route('api.bestseller.toggle') }}" product_id="{{ $product->id }}"></toggle-switch>
                            </td>

                            <td>
                                <toggle-switch toggle="{{ $product->live }}" endpoint="{{ route('api.product.live.toggle') }}" product_id="{{ $product->id }}"></toggle-switch>
                            </td>

                            <td class="td-actions text-right">
                                <a href="{{ route('admin.product.edit', $product->id) }}" rel="tooltip" class="btn btn-success">
                                    <i class="material-icons">edit</i>
                                </a>
                                <button type="button" rel="tooltip" class="btn btn-danger">
                                    <i class="material-icons">close</i>
                                </button>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <div class="mx-auto p-4 text-center">
                        <h4 class="title">Страницы</h4>
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
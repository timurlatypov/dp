@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">IMG</th>
                            <th><nobr>В наличии</nobr></th>
                            <th class="w-25">Название</th>
                            <th class="w-25">Бренд</th>
                            <th class="w-25">Цена</th>
                            <th class="w-25">Скидка</th>
                            <th><nobr>На сайте</nobr></th>
                            <th class="text-right">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                        <tr class="tr-hover">
                            <td style="width: 60px;"><img src="/storage/products/thumb/{{ $product->thumb_path }}" width="45px" height="45px" alt=""></td>
                            <td>
                                <toggle-switch toggle="{{ $product->stock }}" endpoint="{{ route('api.product.stock.toggle') }}" product_id="{{ $product->id }}"></toggle-switch>
                            </td>
                            <td><a href="{{ route('admin.product.edit', $product->id) }}">{{ $product->title_eng }}</a><br><small>{{ $product->title_rus }}</small></td>
                            <td>{{ $product->brand->name }}</td>

                            <td>
                                <input-field value="{{ $product->price }}" endpoint="{{ route('api.product.price.update') }}" product_id="{{ $product->id }}" fontawesome="fa fa-ruble-sign fa-sm" placeholder="Цена" id="inputPrice"></input-field>
                            </td>

                            <td>
                                <input-field value="{{ $product->discount }}" endpoint="{{ route('api.product.discount.update') }}" product_id="{{ $product->id }}" fontawesome="fa fa-percentage" placeholder="Скидка" id="inputDiscount"></input-field>
                            </td>

                            {{--<td>--}}
                              {{--<span class="badge badge-pill badge-success">{{ count( $product->related ) }}</span>--}}
                            {{--</td>--}}

                            <td>
                                <toggle-switch toggle="{{ $product->live }}" endpoint="{{ route('api.product.live.toggle') }}" product_id="{{ $product->id }}"></toggle-switch>
                            </td>



                            <td class="td-actions text-right">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-success">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a href="{{ route('admin.product.delete', $product->id) }}" class="btn btn-danger">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <div class="mx-auto p-4 text-center">
                        <h4 class="title">Страницы</h4>
                        {{ $products->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

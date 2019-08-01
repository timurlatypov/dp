@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card my-3 p-4">
                    <h4 class="title mt-2 mb-2">Фильтры</h4>
                    <div class="d-flex flex-wrap">
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 1 ])) }}" class="btn btn-sm {{ request('brand') === '1' ? 'btn-primary' : 'btn-secondary' }}">Mene & Moy</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 2 ])) }}" class="btn btn-sm {{ request('brand') === '2' ? 'btn-primary' : 'btn-secondary' }}">Corpolibero</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 3 ])) }}" class="btn btn-sm {{ request('brand') === '3' ? 'btn-primary' : 'btn-secondary' }}">Professional Solutions</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 5 ])) }}" class="btn btn-sm {{ request('brand') === '5' ? 'btn-primary' : 'btn-secondary' }}">Skin Renu</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 7 ])) }}" class="btn btn-sm {{ request('brand') === '7' ? 'btn-primary' : 'btn-secondary' }}">Officina Pelle</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 8 ])) }}" class="btn btn-sm {{ request('brand') === '8' ? 'btn-primary' : 'btn-secondary' }}">Evolash</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 9 ])) }}" class="btn btn-sm {{ request('brand') === '9' ? 'btn-primary' : 'btn-secondary' }}">MR</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 10 ])) }}" class="btn btn-sm {{ request('brand') === '10' ? 'btn-primary' : 'btn-secondary' }}">Profillers</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 12 ])) }}" class="btn btn-sm {{ request('brand') === '12' ? 'btn-primary' : 'btn-secondary' }}">B Selfie</a>
                        <a href="{{ route('admin.product.index', array_merge(request()->query(), ['brand' => 11 ])) }}" class="btn btn-sm {{ request('brand') === '11' ? 'btn-primary' : 'btn-secondary' }}">Наборы</a>
                    </div>
                </div>

                <div class="card mt-3 mb-3 p-4">
                    <h4 class="title mt-2 pb-2 mb-2">Продукты</h4>
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

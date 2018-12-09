@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card p-5">
                    <h1 class="title my-0">Детали заказа {{ $order->order_id }}</h1>
                    <h4>Дата: {{ $order->created_at->format('d.m.Y H:i:s') }}</h4>

                    <div class="row pt-3">
                        <div class="col-12">
                            Клиент: <b>{{ $order->billing_name }} {{ $order->billing_surname }}</b><br>
                            Телефон: <b>{{ $order->billing_phone }}</b><br>
                            Email: <b>{{ $order->billing_email }}</b>
                            <br>
                            <h4 class="title mb-0">Адрес доставки:</h4>
                            {{ $order->billing_city }}, {{ $order->billing_street }}, д. {{ $order->billing_house }}, кв/офис: {{ $order->billing_apartment }}<br>
                            Подъезд: {{ $order->billing_entrance }}<br>
                            Этаж: {{ $order->billing_floor }}
                            <br>
                            <h4 class="title mb-0">Комментарий:</h4>
                            {{ $order->billing_comment }}
                            <br><br>
                        </div>
                    </div>

                    <table class="table table-shopping">
                        <thead>
                            <tr>
                                <th style="width: 80px"></th>
                                <th class="w-25">Товары</th>
                                <th class="th-description">Цена</th>
                                <th class="th-description">Скидка</th>
                                <th class="th-description">Цена со скидкой</th>
                                <th class="th-description">Кол-во</th>
                                <th class="th-description">Сумма</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $product)
                            <tr class="font-weight-bold">
                                <td><div class="img-container"><img src="/storage/products/thumb/{{ $product->options->image }}"></div></td>
                                <td>
                                    <b class="text-primary">{{ $product->name }}</b><br>
                                    @isset($product->options->title_rus){{ $product->options->title_rus }}@endisset<br>
                                    <small class="text-uppercase">{{ $product->options->brand }}</small>
                                </td>
                                <td>{{ $product->price }} &#x20BD;</td>
                                <td>@isset($product->biggest_discount)-{{ $product->biggest_discount }}%@endisset</td>
                                <td>@isset($product->discounted_price){{ number_format((float)$product->discounted_price, 2, '.', '') }} &#x20BD;@endisset</td>
                                <td>{{ $product->qty }} шт.</td>
                                <td>{{ number_format((float)$product->subtotal, 2, '.', '') }} &#x20BD;</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="5" rowspan="10">
                                <td><h4 class="title">Итого</h4></td>
                                <td>
                                    <h4 class="title">{{ $order->billing_total }} &#x20BD;</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-right">
                        <a href="/admin-panel/orders/{{ $order->id }}/edit" class="btn btn-danger" >Изменить заказ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
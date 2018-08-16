@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card p-4">
                    <h1>Детали заказа {{ $order->order_id }}</h1>
                    <h4>{{ $order->created_at->format('d.m.Y') }}</h4>

                    <div class="row">
                        <div class="col-6">
                            <h4 class="title">Покупатель</h4>

                            <p>{{ $order->billing_name }} {{ $order->billing_surname }}</p>

                            <p>{{ $order->billing_phone }}</p>
                            <p>{{ $order->billing_email }}</p>

                        </div>

                        <div class="col-6">
                            <h4 class="title">Адрес доставки</h4>
                            <p>{{ $order->billing_city }}, {{ $order->billing_street }}, д.{{ $order->billing_house }}, @isset($order->billing_apartment)кв.{{$order->billing_apartment}}@endisset</p>
                            <p>@isset($order->billing_entrance)Подъезд: {{ $order->billing_entrance }}@endisset</p>
                            <p>@isset($order->billing_floor)Этаж: {{ $order->billing_floor }}@endisset</p>
                            <p>Комментарий:<br>{{ $order->billing_comment }}</p>
                        </div>



                    </div>

                    <table class="table table-shopping">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="w-50">Товары</th>
                                <th class="th-description">Цена</th>
                                <th class="th-description">Количество</th>
                                <th class="th-description">Сумма</th>
                                <th class="text-center" style="width: 60px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $product)
                            <tr>
                                <td><div class="img-container"><img src="/storage/products/thumb/{{ $product->options->image }}"></div></td>
                                <td class="td-name">
                                    <a href="#">{{ $product->name }}</a>
                                    <br><small class="text-uppercase">{{ $product->options->brand }}</small>
                                </td>
                                <td>{{ $product->price }}</td>
                                <td class="td-actions">
                                    <ul role="navigation" class="pagination my-0">
                                        <li class="page-item active">
                                            <span class="page-link"><strong>{{ $product->qty }}</strong></span>
                                        </li>
                                    </ul>
                                </td>
                                <td class="td-number">{{ $product->subtotal }}</td>
                                <td class="td-actions text-center"></td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="3" rowspan="10">
                                <td>Общая сумма</td>
                                <td> {{ $order->billing_subtotal }}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>Доставка</td>
                                <td>{{ $order->billing_delivery }}</td>
                                <td></td>
                            </tr>

                            @if ( $order->billing_loyalty > 0 )
                            <tr>
                                <td>Любимый клиент</td>
                                <td>-{{ $order->billing_loyalty }}%</td>
                                <td></td>
                            </tr>
                            @endif

                            @if ( $coupon->value )
                            <tr>
                                <td>Купон: <strong>{{ $coupon->coupon }}</strong></td>
                                <td>-{{ $coupon->discount }}%</td>
                                <td></td>
                            </tr>
                            @endif


                            <tr>
                                <td>Итого</td>
                                <td>{{ $order->billing_total }}</td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
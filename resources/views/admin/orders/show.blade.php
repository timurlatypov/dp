@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card mt-3 mb-3 p-5">
                    <h1 class="title my-0">Заказ {{ $order->order_id }}</h1>
                    <h5 class="text-muted">Дата: {{ $order->created_at->format('d.m.Y H:i:s') }}</h5>

                    <div class="container-fluid px-0">
                        <div class="row pt-3 mx-0">
                            <div class="col-12 col-sm-6 px-0">
                                <h4 class="title mt-2 mb-2">Детали заказа <span class="badge badge-secondary">
                                        <a href="{{ route('admin.orders.edit_details', $order) }}" class="text-white">Редактировать</a>
                                    </span>
                                </h4>
                                Клиент: <b>{{ $order->billing_name }} {{ $order->billing_surname }}</b><br>
                                Телефон: <b>{{ $order->billing_phone }}</b><br>
                                Email: <b>{{ $order->billing_email }}</b>
                                <br>
                                <h4 class="title mb-0">Адрес доставки:</h4>
                                @if($order->billing_index){{ $order->billing_index }},&nbsp;@endif
                                @if($order->billing_city){{ $order->billing_city }}@endif
                                @if($order->billing_street),&nbsp;{{ $order->billing_street }}@endif
                                @if($order->billing_house),&nbsp;дом {{ $order->billing_house }}@endif
                                @if($order->billing_building),&nbsp;корпус/строение: {{ $order->billing_building }}@endif
                                @if($order->billing_apartment),&nbsp;кв/офис: {{ $order->billing_apartment }}@endif
                                @if($order->billing_entrance),&nbsp;подъезд: {{ $order->billing_entrance }}@endif
                                @if($order->billing_floor),&nbsp;этаж: {{ $order->billing_floor }}@endif
                                <br>
                                <h4 class="title mb-0">Комментарий:</h4>
                                {{ $order->billing_comment }}
                                <br><br>
                            </div>

                            <div class="col-12 col-sm-6 px-0">
                                @if($order->payment)
                                    <h4 class="title mt-2 mb-2">Управление онлайн-оплатой</h4>
                                    @if($order->payment->status === \App\Billing\PaymentStatusEnum::PENDING)
                                        <p class="text-success">Ссылка на оплату заказа в Альфа-банк создана!</p>
                                        <a href="{{ $order->payment->form_url }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Ссылка на страницу оплаты Альфа-банк">Оплатить</a>
{{--                                        <a href="{{ route('admin.orders.reverseOrder', $payment->payment_id ) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Если клиент передумал сразу после оплаты!">Отмена оплаты</a>--}}
                                        <a href="{{ route('billing.gateway.invalidatePaymentLink', $order->payment->hash ) }}" class="btn btn-sm btn-danger">Удалить ссылку</a>

                                        <h4 class="title mt-2 mb-2">Ссылка</h4>
                                        <p style="padding: 0.5em; background-color: #f3f3f3; border-radius: 5px; font-weight: bold">{{ $order->payment->form_url }}</p>

                                        <div class="pt-3">
                                            <h4 class="title mt-2 mb-2">Выслать ссылку клиенту</h4>
                                            <a href="{{ route('billing.gateway.sendLink', $order) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-sm fa-paper-plane"></i>&nbsp;<span class="font-weight-bold">Отправить письмо</span>
                                            </a>
                                        </div>
                                    @elseif($order->payment->status === \App\Billing\PaymentStatusEnum::PAID)
                                        <span class="font-weight-bold text-success">Заказ оплачен онлайн</span>
                                    @endif
                                @else
                                    <h4 class="title mt-2 mb-1">Альба-банк</h4>
                                    <small class="text-danger font-weight-bold">Убедитесь, что в заказе сумма и стоимость доставки правильные!</small>
                                    <br>
                                    <a href="{{ route('billing.gateway.registerOrder', $order) }}" class="btn btn-success btn-sm">Создать ссылку</a>
                                @endif



                                <h4 class="title mt-2 mb-2">Подтверждение заказа по Email</h4>
                                <a href="{{ route('admin.orders.resendConfirmation', $order) }}" class="btn btn-info btn-sm">Выслать письмо</a>
                                <br>
                                <br>
                                @if($coupon && !is_null($coupon->coupon))
                                    <div
                                        class="mb-2"
                                        style="border: 2px green solid; border-radius: 10px; padding-top: 4px; padding-bottom: 4px; padding-left: 10px;">
                                        <span>Промокод: </span>
                                        <span style="font-weight: bold">{{ $coupon->coupon }}</span>
                                    </div>
                                @endif
                                @if($giftCard)
                                    <div
                                        class="mb-4"
                                        style="border: 2px red solid; border-radius: 10px; padding-top: 4px; padding-bottom: 4px; padding-left: 10px;">
                                        <span>Подарочная карта: </span>
                                        <span style="font-weight: bold">{{ $giftCard->code }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <table class="table table-shopping">
                        <thead>
                            <tr>
                                <th style="width: 80px"></th>
                                <th class="w-25">Товары</th>
                                <th class="th-description">Цена</th>
                                <th class="th-description">Скидка</th>
                                <th class="th-description">Промокод</th>
                                <th class="th-description">Цена со скидкой</th>
                                <th class="th-description">Кол-во</th>
                                <th class="th-description">Сумма</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $product)
                            <tr class="font-weight-bold">
                                <td><div class="img-container"><img src="/storage/{{ $product->options->image }}"></div></td>
                                <td>
                                    <b class="text-primary">{{ $product->name }}</b><br>
                                    @if(isset($product->options->product->title_rus)){{ $product->options->product->title_rus }}@else{{ $product->options->title_rus }}@endif<br>
                                    <small class="text-uppercase">@if(isset($product->options->brand->name)){{ $product->options->brand->name }}@else {{ $product->options->brand }} @endif</small>
                                </td>
                                <td>{{ $product->price }} &#x20BD;</td>
                                <td class="text-danger">@if(isset($product->options->discount))-{{ $product->options->discount }}%@endif</td>
                                <td class="text-success">@if(isset($product->options->coupon))-{{ $product->options->coupon }}%@else @endif</td>
                                <td>@isset($product->discounted_price){{ number_format((float)$product->discounted_price, 2, '.', '') }} &#x20BD;@endisset</td>
                                <td>{{ $product->qty }} шт.</td>
                                <td>{{ number_format((float)$product->subtotal, 2, '.', '') }} &#x20BD;</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="3" class="">
                                </td>
                                <td colspan="5" class="text-right" rowspan="10">
                                    <h4 class="title mt-2 mb-0">Сумма: {{ number_format((float)$order->billing_subtotal, 2, '.', '') ?? 0 }}</h4>
                                    <h4 class="title mt-2 mb-0">Доставка: {{ number_format((float)$order->billing_delivery, 2, '.', '') ?? 0 }}</h4>
                                    <h4 class="title mt-2 mb-0">Итого: {{ number_format((float)$order->billing_total, 2, '.', '') }}</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-right">
                        <a href="/admin-panel/orders/{{ $order->id }}/edit" class="btn btn-danger">
                            <i class="material-icons">edit</i>
                            Изменить заказ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

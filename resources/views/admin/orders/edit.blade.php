@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3 mb-3 p-5">
                    <h1 class="title my-0">Детали заказа {{ $order->order_id }}</h1>
                    <h4>Дата: {{ $order->created_at->format('d.m.Y H:i:s') }}</h4>

                    <div class="row pt-3">
                        <div class="col-12">
                            Клиент: <b>{{ $order->billing_name }} {{ $order->billing_surname }}</b><br>
                            Телефон: <b>{{ $order->billing_phone }}</b><br>
                            Email: <b>{{ $order->billing_email }}</b>
                            <br>
                            <h4 class="title mb-0">Адрес доставки:</h4>
                            @if($order->billing_index){{ $order->billing_index }},&nbsp;@endif
                            @if($order->billing_city){{ $order->billing_city }}@endif
                            @if($order->billing_street),&nbsp;{{ $order->billing_street }}@endif
                            @if($order->billing_house),&nbsp;дом {{ $order->billing_house }}@endif
                            @if($order->billing_apartment),&nbsp;кв/офис: {{ $order->billing_apartment }}@endif
                            @if($order->billing_entrance),&nbsp;подъезд: {{ $order->billing_entrance }}@endif
                            @if($order->billing_floor),&nbsp;этаж: {{ $order->billing_floor }}@endif
                            <br>
                            <h4 class="title mb-0">Комментарий:</h4>
                            {{ $order->billing_comment }}
                            <br><br>
                        </div>
                    </div>

                    <order-edit-form
                            :details="{{ json_encode($details) }}" :id="{{ $order->id }}"
                            :billing_subtotal="{{ $order->billing_subtotal ?? 0 }}"
                            :billing_delivery="{{ $order->billing_delivery ?? 0 }}"
                            :billing_total="{{ $order->billing_total }}"></order-edit-form>

                </div>
            </div>
        </div>
    </div>
@endsection
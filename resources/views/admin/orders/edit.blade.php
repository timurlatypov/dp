@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="text-left mb-2 mt-2">
                    <a href="{{ url()->previous() }}" class="btn btn-sm" >
                        <i class="material-icons">arrow_back</i>
                        Назад
                    </a>
                </div>
                <div class="card mt-1 mb-3 p-5">
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

                    <order-edit-form :details="{{ json_encode($details) }}" :id="{{ $order->id }}" :billing_subtotal="{{ $order->billing_subtotal ?? 0 }}" :billing_delivery="{{ $order->billing_delivery ?? 0 }}" :billing_total="{{ $order->billing_total }}"></order-edit-form>

                </div>
            </div>
        </div>
    </div>
@endsection
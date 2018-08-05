@extends('account.index')

@section('information')
    <h5 class="title mt-0 mb-3">Ваши заказы</h5>

    @if (count($orders))
    @foreach ($orders as $order)
        <p>{{ $order->order_id }} - {{ $order->created_at }} - {{ $order->order_status }} - {{ $order->billing_total }}</p>
    @endforeach
    @else
        <p>У Вас еще нет заказов</p>
    @endif

@endsection
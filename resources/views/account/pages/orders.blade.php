@extends('account.index')

@section('information')
    <h4 class="title">Ваши заказы</h4>

    @if (count($orders))
        <table class="table table-shopping table-user-orders">

            <thead>
            <tr>
                <th>Номер</th>
                <th>Дата</th>
                <th class="th-description">Сумма заказа</th>
                <th class="th-description">Статус</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>{{ $order->billing_total }} &#x20BD;</td>
                    <td>{!! $order->order_current_status !!}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <div class="mx-auto p-4 text-center">
            {{ $orders->links() }}
        </div>
    @else
        <p>У Вас еще нет заказов</p>
    @endif

@endsection
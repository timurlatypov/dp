@extends('account.index')

@section('information')
    <h4 class="title">Ваши заказы</h4>

    @if (count($orders))
        <table class="table table-shopping table-user-orders">

            <thead>
            <tr>
                <th>Номер</th>
                <th class="th-description">Статус</th>
                <th>Дата</th>
                <th class="th-description">Сумма</th>
                <th class="th-description">Доставка</th>
                <th class="th-description">Итого</th>
                <th>Оплатить онлайн</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{!! $order->order_current_status !!}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>{{ $order->billing_subtotal ?? $order->billing_total }} &#x20BD;</td>
                    <td>{{ $order->billing_delivery ?? number_format((float) 0, 2, '.', '') }} &#x20BD;</td>
                    <td>{{ $order->billing_total }} &#x20BD;</td>
                    <td>@if($order->payment)
                            @if($order->payment->status === 0)
                                <a href="{{ $order->payment->form_url }}" class="btn btn-success btn-sm my-0">Оплатить онлайн</a>
                            @elseif($order->payment->status === 1)
                                <span class="font-weight-bold text-success">Заказ оплачен онлайн</span>
                            @else
                                <span class="font-weight-bold text-muted">Нет информации</span>
                            @endif
                        @else @endif</td>
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
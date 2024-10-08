@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card my-3 p-2">
                    <div class="d-flex flex-wrap">
                        <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-success font-weight-bold">
                            <i class="material-icons">add</i>
                            Создать заказ
                        </a>
                    </div>
                </div>

                <div class="card my-3 p-4">

                        <form action="{{ route('admin.orders.index') }}" method="GET">
                            <div class="d-flex">
                                <div class="form-group">
                                    <label for="surname">Фамилия</label>
                                    <input id="surname" name="surname" type="text" class="form-control" value="{{  request()->query('surname') ?? null }}">
                                </div>

                                <div class="form-group">
                                    <label for="surname">Email</label>
                                    <input id="surname" name="email" type="text" class="form-control" value="{{  request()->query('email') ?? null }}">
                                </div>

                                <div class="form-group">
                                    <label for="surname">Телефон</label>
                                    <input id="surname" name="phone" type="text" class="form-control" value="{{  request()->query('phone') ?? null }}">
                                </div>

                                <div class="form-group">
                                    <label for="from">From</label>
                                    <input id="from" name="from" type="date" class="form-control" value="{{  request()->query('from') ?? null }}">
                                </div>

                                <div class="form-group">
                                    <label for="to">To</label>
                                    <input id="to" name="to" type="date" class="form-control" value="{{  request()->query('to') ?? null }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success font-weight-bold">
                                Применить
                            </button>
                        </form>


                </div>

                <div class="card mt-3 mb-3 p-4">
                    <h4 class="title mt-2 pb-2 mb-2">Заказы</h4>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Покупатель</th>
                            <th>Менеджер</th>
                            <th>Статус заказа</th>
                            <th>Дата заказа</th>
                            <th>Сумма</th>
                            <th>Способ оплаты</th>
                            <th class="text-right">Действие</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $key => $order)
                            <tr style="@if($order->order_status === 'Новый')background-color: rgba(0,255,0,0.1)@elseif($order->order_status === 'В работе')background-color: rgba(255,255,0,0.1)@endif">
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-muted font-weight-bold">{{ $order->order_id }}</a>
                                </td>
                                <td>
                                    <span class="{{ $order->manager_id === auth()->user()->id ? 'font-weight-bold' : 'text-muted' }}">{{ $order->billing_name }} {{ $order->billing_surname }}</span>
                                </td>
                                <td>
                                    @if( $order->manager_id === auth()->user()->id )
                                        <strong>{{ $order->manager->full_name }}</strong>
                                    @elseif ($order->manager_id)
                                        <span class="text-muted">{{ $order->manager->full_name }}</span>
                                    @else
                                        <button class="btn btn-default btn-sm" data-id="{{ $order->id }}" data-order="{{ $order->order_id }}" data-manager="{{ auth()->user()->full_name }}" data-managerid="{{ auth()->user()->id }}" data-toggle="modal" data-target="#assignOrderManagerModal">Взять заказ</button>
                                    @endif
                                </td>
                                <td>

                                    @if( $order->manager_id === auth()->user()->id )
                                        <button type="button" class="btn btn-default btn-sm" data-id="{{ $order->id }}" data-order="{{ $order->order_id }}" data-toggle="modal" data-target="#changeOrderStatusModal">
                                            {{ $order->order_status }} <i class="material-icons">refresh</i>
                                        </button>
                                    @else
                                        <span class="{{ $order->order_status === 'Новый' ? 'text-success' : 'text-muted' }}">{{ $order->order_status }}</span>
                                    @endif

                                </td>
                                <td class="text-muted">{{ $order->created_at->format('d.m.Y H:i:s') }}</td>
                                <td>{{ $order->billing_total }} &#x20BD;</td>
                                <td>
                                    @if($order->payment)
                                        @if($order->payment->status === \App\Billing\PaymentStatusEnum::PENDING)
                                            <span class="text-warning">Ожидает оплату</span>
                                        @elseif($order->payment->status === \App\Billing\PaymentStatusEnum::PAID)
                                            <span class="font-weight-bold text-success">Оплачен онлайн</span>
                                        @else
                                            <span class="font-weight-bold text-muted">Нет информации</span>
                                        @endif
                                    @else
                                        <b>{{ $order->order_payment }}</b>&nbsp;
                                        <button style="opacity: 0.25;" type="button" class="btn btn-success btn-sm btn-fab" data-id="{{ $order->id }}" data-order="{{ $order->order_id }}" data-toggle="modal" data-target="#changeOrderPaymentModal">
                                             <i class="material-icons">refresh</i>
                                        </button>
                                    @endif
                                </td>

                                <td class="td-actions text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary mr-2">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    <button type="button" class="btn btn-danger" data-id="{{ $order->id }}" data-order="{{ $order->order_id }}" data-toggle="modal" data-target="#deleteOrderModal">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>


                    <div class="mx-auto p-4 text-center">
                        <h4 class="title">Страницы</h4>
                        {{ $orders->appends(request()->query())->links() }}
                    </div>


                    <div class="modal fade" id="assignOrderManagerModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-danger" id="ModalLabel">Подтвердите действие</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{ route('admin.orders.assign') }}">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="id" id="id" hidden>
                                            <label for="order">Заказ</label>
                                            <input type="text" class="form-control" name="order" id="order" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="manager">Ответственный менеджер</label>
                                            <input type="text" class="form-control" name="manager" id="manager" disabled>
                                            <input type="text" class="form-control" name="managerid" id="managerid" hidden>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm mr-2" data-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Да</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteOrderModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-danger" id="ModalLabel">Подтвердите действие</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{ route('admin.orders.destroy') }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="id" id="id" hidden>
                                            <label for="order">Заказ</label>
                                            <input type="text" class="form-control" name="order" id="order" disabled>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm mr-2" data-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="changeOrderStatusModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-danger" id="ModalLabel">Подтвердите действие</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{ route('admin.orders.change.status') }}">
                                    {{ csrf_field() }}

                                    <input type="text" class="form-control" name="id" id="id" hidden>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <h4 class="modal-title">Статус заказа <span id="order"></span></h4>
                                        </div>

                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label text-default">
                                                <input class="form-check-input" type="radio" name="order_status" value="Новый" checked>
                                                Новый
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="order_status" value="В работе">
                                                В работе
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="order_status" value="Доставлен">
                                                Доставлен
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="order_status" value="Отменен">
                                                Отменен
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm mr-2" data-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-danger btn-sm">Изменить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="changeOrderPaymentModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-danger" id="ModalLabel">Подтвердите действие</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" action="{{ route('admin.orders.change.payment') }}">
                                    {{ csrf_field() }}

                                    <input type="text" class="form-control" name="id" id="id" hidden>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <h4 class="modal-title">Способ оплаты заказа <span id="order"></span></h4>
                                        </div>

                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label text-default">
                                                <input class="form-check-input" type="radio" name="order_payment" value="Наличные" checked>
                                                Наличные
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label text-default">
                                                <input class="form-check-input" type="radio" name="order_payment" value="Карта">
                                                Карта
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="order_payment" value="Счет">
                                                Счет
                                                <span class="circle">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-sm mr-2" data-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-danger btn-sm">Изменить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card p-4">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Покупатель</th>
                            <th>Менеджер</th>
                            <th>Статус заказа</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th class="text-right">Действие</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $key => $order)
                            <tr style="@if($order->order_status === 'Новый')background-color: rgba(0,255,0,0.1)@endif">
                                <td>
                                    <a href="#" class="{{ $order->order_status === 'Новый' ? 'text-success' : 'text-muted' }}">{{ $order->order_id }}</a>
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




                </div>
            </div>
        </div>
    </div>
@endsection
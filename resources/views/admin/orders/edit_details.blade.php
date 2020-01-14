@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3 mb-3 p-5">
                    <h1 class="title my-0">Детали заказа {{ $order->order_id }}</h1>
                    <h4>Дата: {{ $order->created_at->format('d.m.Y H:i:s') }}</h4>
                    <form class="form" method="post" action="{{ route('admin.orders.update_details', $order) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="row pt-3">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group pb-3">
                                    <label for="billing_name"><b>Имя</b></label>
                                    <input name="billing_name" type="text"
                                           class="input form-control{{ $errors->has('billing_name') ? ' is-invalid' : '' }}"
                                           id="billing_name"
                                           value="{{ old('billing_name') ? : $order->billing_name }}">
                                    @if ($errors->has('billing_name'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_name') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group pb-3">
                                    <label for="billing_surname"><b>Фамилия</b></label>
                                    <input name="billing_surname" type="text"
                                           class="input form-control{{ $errors->has('billing_surname') ? ' is-invalid' : '' }}"
                                           id="billing_surname"
                                           value="{{ old('billing_surname') ? : $order->billing_surname }}">
                                    @if ($errors->has('billing_surname'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_surname') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group pb-3">
                                    <label for="billing_phone"><b>Телефон</b></label>
                                    <input name="billing_phone" type="text"
                                           class="input form-control{{ $errors->has('billing_phone') ? ' is-invalid' : '' }}"
                                           id="billing_phone"
                                           value="{{ old('billing_phone') ? : $order->billing_phone }}">
                                    @if ($errors->has('billing_phone'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_phone') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group pb-3">
                                    <label for="billing_email"><b>Email</b></label>
                                    <input name="billing_email" type="text"
                                           class="input form-control{{ $errors->has('billing_email') ? ' is-invalid' : '' }}"
                                           id="billing_email"
                                           value="{{ old('billing_email') ? : $order->billing_email }}">
                                    @if ($errors->has('billing_email'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_email') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <h4 class="title mb-0">Адрес доставки:</h4>

                        <div class="row pt-3">
                            <div class="col-12 col-sm-4 col-md-4">
                                <div class="form-group pb-3">
                                    <label for="billing_index"><b>Индекс</b></label>
                                    <input name="billing_index" type="text"
                                           class="input form-control{{ $errors->has('billing_index') ? ' is-invalid' : '' }}"
                                           id="billing_index"
                                           value="{{ old('billing_index') ? : $order->billing_index }}">
                                    @if ($errors->has('billing_index'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_index') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-sm-4 col-md-4">
                                <div class="form-group pb-3">
                                    <label for="billing_city"><b>Город</b></label>
                                    <input name="billing_city" type="text"
                                           class="input form-control{{ $errors->has('billing_city') ? ' is-invalid' : '' }}"
                                           id="billing_city" value="{{ old('billing_city') ? : $order->billing_city }}">
                                    @if ($errors->has('billing_city'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_city') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-sm-4 col-md-4">
                                <div class="form-group pb-3">
                                    <label for="billing_street"><b>Улица</b></label>
                                    <input name="billing_street" type="text"
                                           class="input form-control{{ $errors->has('billing_street') ? ' is-invalid' : '' }}"
                                           id="billing_street"
                                           value="{{ old('billing_street') ? : $order->billing_street }}">
                                    @if ($errors->has('billing_street'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_street') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-12 col-sm-3 col-md-3">
                                <div class="form-group pb-3">
                                    <label for="billing_house"><b>Дом</b></label>
                                    <input name="billing_house" type="text"
                                           class="input form-control{{ $errors->has('billing_house') ? ' is-invalid' : '' }}"
                                           id="billing_house"
                                           value="{{ old('billing_house') ? : $order->billing_house }}">
                                    @if ($errors->has('billing_house'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_house') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-sm-3 col-md-3">
                                <div class="form-group pb-3">
                                    <label for="billing_apartment"><b>№ Кв/Офис</b></label>
                                    <input name="billing_apartment" type="text"
                                           class="input form-control{{ $errors->has('billing_apartment') ? ' is-invalid' : '' }}"
                                           id="billing_apartment"
                                           value="{{ old('billing_apartment') ? : $order->billing_apartment }}">
                                    @if ($errors->has('billing_apartment'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_apartment') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-sm-3 col-md-3">
                                <div class="form-group pb-3">
                                    <label for="billing_entrance"><b>Подъезд</b></label>
                                    <input name="billing_entrance" type="text"
                                           class="input form-control{{ $errors->has('billing_entrance') ? ' is-invalid' : '' }}"
                                           id="billing_entrance"
                                           value="{{ old('billing_entrance') ? : $order->billing_entrance }}">
                                    @if ($errors->has('billing_entrance'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_entrance') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-3 col-md-3">
                                <div class="form-group pb-3">
                                    <label for="billing_floor"><b>Этаж</b></label>
                                    <input name="billing_floor" type="text"
                                           class="input form-control{{ $errors->has('billing_floor') ? ' is-invalid' : '' }}"
                                           id="billing_floor"
                                           value="{{ old('billing_floor') ? : $order->billing_floor }}">
                                    @if ($errors->has('billing_floor'))
                                        <small class="invalid-feedback">{{ $errors->first('billing_floor') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="form-group pb-3">
                                    <label for="billing_comment"><b>Комментарий</b></label>
                                    <textarea name="billing_comment" id="billing_comment" cols="30" rows="4"
                                              class="input form-control{{ $errors->has('billing_comment') ? ' is-invalid' : '' }}">{{ old('billing_comment') ? : $order->billing_comment }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button class="btn" type="submit">Обновить</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

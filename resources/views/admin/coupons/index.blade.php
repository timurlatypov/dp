@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="title">Промокоды</h4>

                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="w-25">Промокод</th>
                                <th class="w-25">Скидка</th>
                                <th class="w-25">Многоразовый</th>
                                <th class="w-25">Использован</th>
                                <th><nobr>Действует до</nobr></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->coupon }}</td>
                                    <td>{{ $coupon->discount }}%</td>
                                    <td>{{ $coupon->reusable ? 'Да' : 'Нет' }}</td>
                                    <td>{{ $coupon->used ? 'Да' : 'Нет' }}</td>
                                    <td>{{ $coupon->expired_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
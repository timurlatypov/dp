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

                <div class="card mt-3 mb-3 p-4">
                    <h1 class="title mt-0 mb-3">Новый заказ</h1>

                    <order-create-form></order-create-form>

                </div>
            </div>
        </div>
    </div>
@endsection
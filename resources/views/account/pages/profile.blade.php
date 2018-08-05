@extends('account.index')

@section('information')
    <h5 class="title mt-0 mb-3">Ваш профиль</h5>
    <p>Имя: {{ $user->name }}</p>
    <p>Фамилия: {{ $user->surname }}</p>
    <p>Телефон: {{ $user->phone }}</p>
@endsection
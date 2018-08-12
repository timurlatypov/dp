@extends('account.index')

@section('information')
    <h4 class="title">Программа лояльности "Любимый клиент"</h4>

    <p>Ваша персональная скидка: {{ $user->loyalty }}%</p>
    <p>Общая сумма заказов: {{ $user->totalSum() }} &#x20BD;</p>

    <p>Hello W</p>
@endsection


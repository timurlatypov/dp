@extends('account.index')

@section('information')
    <h5 class="title mt-0 mb-3">Адреса доставки</h5>

    @if(count($addresses))
    @foreach ($addresses as $address)
        <p>{{ $address->address_name }}</p>
    @endforeach
    @else
        <p>У вас нет сохраненных адресов для доставки</p>
        <p>Новый адрес</p>
    @endif
@endsection
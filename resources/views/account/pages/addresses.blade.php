@extends('account.index')

@section('information')
    <h4 class="title">Адреса доставки</h4>

    @if(count($addresses))
    @foreach ($addresses as $address)
        <p>{{ $address->address_name }}</p>
    @endforeach
    @else
        <p>У вас нет сохраненных адресов</p>
    @endif
@endsection
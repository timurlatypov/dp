@extends('account.index')

@section('information')
    <h4 class="title">Ваш профиль</h4>

    <form class="form" action="{{ route('account.profile.update') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group account">
            <label for="name"><b>Имя</b></label>
            <input type="text" class="input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', optional($user)->name) }}">
            @if ($errors->has('name'))
                <small class="invalid-feedback">{{ $errors->first('name') }}</small>
            @endif
        </div>

        <div class="form-group account">
            <label for="surname"><b>Фамилия</b></label>
            <input type="text" class="input form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="surname" value="{{ old('name', optional($user)->surname) }}">
            @if ($errors->has('surname'))
                <small class="invalid-feedback">{{ $errors->first('surname') }}</small>
            @endif
        </div>

        <div class="form-group account">
            <label for="surname"><b>Телефон</b></label>
            <input type="text" class="input form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" value="{{ old('name', optional($user)->phone) }}">
            @if ($errors->has('phone'))
                <small class="invalid-feedback">{{ $errors->first('phone') }}</small>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>

@endsection
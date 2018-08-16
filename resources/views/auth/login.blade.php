@extends('layouts.app')

@section('content')
    <div class="container p-2 p-md-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card" id="login-id">
                    <div class="card-header card-header-doctorproffi text-center">
                        <h3 class="card-title mb-1 mt-0">Авторизация на сайте</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-form-label">Пароль</label>
                                <div class="">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group text-center py-3 mb-0">
                                <button type="submit" class="btn btn-primary">Войти</button>
                                <span class="text-muted"> или </span>
                                <a href="{{ route('register') }}" class="btn btn-info">Регистрация</a>
                                <a class="btn btn-link mt-4" href="{{ route('password.request') }}">Забыли свой пароль?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

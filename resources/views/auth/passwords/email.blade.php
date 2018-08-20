@extends('layouts.app')

@section('content')
    <div class="container p-2 p-md-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header card-header-doctorproffi text-center">
                        <h3 class="card-title mb-1 mt-0">Восстановить пароль</h3>
                    </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-form-label">Ваш email</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group text-center py-3 mb-0">
                            <button type="submit" class="btn btn-primary">Выслать ссылку</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

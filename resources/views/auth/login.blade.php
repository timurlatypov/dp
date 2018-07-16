@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card card-login">
                    <form class="form" method="" action="">
                        <div class="card-header card-header-warning text-center">
                            <h4 class="card-title">Сезонное предложение</h4>
                        </div>
                        <p class="description text-center">Or Be Classical</p>
                        <div class="card-body">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                      <i class="material-icons">face</i>
                                  </span>
                                </div>

                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Ваше имя</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                      <span class="input-group-text">
                          <i class="material-icons">mail</i>
                      </span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email...">
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                      <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                      </span>
                                </div>

                                <input type="password" class="form-control" placeholder="Password...">
                            </div>

                        </div>
                        <div class="footer text-center">
                            <a href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Get Started</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

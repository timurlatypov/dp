@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title my-2">Личный кабинет</h4>

                        @include('account.partials._nav')

                        <div class="tab-content tab-space">
                            <div class="tab-pane active show">
                                @yield('information')
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
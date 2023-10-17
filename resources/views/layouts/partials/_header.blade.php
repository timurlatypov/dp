<header>
    <div class="hidden-lg bg-info">
        <div class="container px-5">
            <div class="row d-flex justify-content-between align-items-center font-weight-bold text-white py-2">
                <p class="px-2 text-sm"><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;100% ОРИГИНАЛЬНАЯ ПРОДУКЦИЯ</p>
                <p class="px-2 text-sm"><i class="fa fa-shipping-fast"></i>&nbsp;&nbsp;<a href="/delivery" class="text-white">БЕСПЛАТНАЯ ДОСТАВКА ОТ 5000р.</a></p>
                <p class="px-2 text-sm"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;<a class="text-white" href="https://api.whatsapp.com/send?phone=79253170148" onclick="yaCounter35424225.reachGoal('whatsapp'); return true;">8 (925) 317-01-48</a></p>
                <p class="px-2 text-sm"><i class="fa fa-phone-volume"></i>&nbsp;&nbsp;<a class="text-white" href="tel:84953801141" onclick="yaCounter35424225.reachGoal('phone'); return true;">8 (495) 380-11-41</a></p>
            </div>
        </div>
    </div>
    <div class="bg-white hidden-lg">
        <div class="container">

            <div class="row py-3">
                <div class="col-3 align-self-center">
                    <div class="header-logo py-4" style="min-height: 100px;">
                        <a href="/">@include('layouts.partials._logo')</a>
                    </div>
                </div>
                <div class="col-6 align-self-center algolia-search">
                    <search></search>
                    <div class="text-center">
{{--                        <p class="tw-pb-1 m-0 tw-font-bold tw-font-base tw-text-red-700">БЕСКОНТАКТНАЯ ДОСТАВКА КУРЬЕРОМ</p>--}}
{{--                        <p class="tw-pb-1 m-0 tw-font-bold tw-font-base tw-text-red-700">ОНЛАЙН-ОПЛАТА ЗАКАЗОВ</p>--}}
                    </div>
                </div>
                <div class="col-3 text-right align-self-center px-0">
                    @guest
                        <a class="btn btn-primary btn-sm font-weight-bold" href="{{ route('login') }}"><i class="fas fa-sign-in-alt fa-sm"></i>&nbsp;&nbsp;Войти</a><br>
                        <a class="btn btn-primary btn-sm font-weight-bold" href="{{ route('register') }}"><i class="fas fa-user fa-sm"></i>&nbsp;&nbsp;Регистрация</a>
                        <a class="btn btn-info btn-sm font-weight-bold" href="#" onclick="$('#requestCallback').modal('show')"><i class="fas fa-phone fa-sm"></i>&nbsp;&nbsp;Заказать консультацию</a>
                        @else
                            <a class="btn btn-secondary" href="{{ route('account.profile') }}"><i class="material-icons">account_box</i> Кабинет<div class="ripple-container"></div></a>
                            <button type="button" class="btn btn-secondary btn-secondary btn-fab" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="material-icons">exit_to_app</i>
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials._nav')
</header>

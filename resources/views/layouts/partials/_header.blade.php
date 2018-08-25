<header>
    <div class="hidden-lg bg-darkred">
        <div class="container-fluid px-5">
            <div class="row d-flex justify-content-around align-items-center header-top-line px-5">
                <div class=""><h6><i class="fa fa-thumbs-up fa-lg"></i>&nbsp;&nbsp;100% ОРИГИНАЛЬНАЯ ПРОДУКЦИЯ</h6></div>
                <div><h6><i class="fa fa-percentage fa-lg"></i>&nbsp;&nbsp;СКИДКА -3% ПРИ РЕГИСТРАЦИИ</h6></div>
                <div class=""><h6><i class="fa fa-gift fa-lg"></i>&nbsp;&nbsp;<a href="/loyalty" class="text-white">ПРОГРАММА ЛОЯЛЬНОСТИ</a></h6></div>
                <div class=""><h6><i class="fa fa-shipping-fast fa-lg"></i>&nbsp;&nbsp;<a href="/delivery" class="text-white">БЕСПЛАТНАЯ ДОСТАВКА ОТ 3000р.</a></h6></div>
                <div class=""><h6><a class="text-white" href="https://api.whatsapp.com/send?phone=79654433130" data-toggle="tooltip" data-placement="bottom" title="Написать в Whatsapp"><i class="fab fa-whatsapp fa-lg"></i>&nbsp;&nbsp;<b>8 (965) 443-31-30</b></a></h6></div>
                <div class=""><h6><a class="text-white" href="tel:84953801141"><i class="fa fa-phone-volume fa-lg"></i>&nbsp;&nbsp;<b>8 (495) 380-11-41</b></a></h6></div>
            </div>
        </div>
    </div>

    <div class="bg-white hidden-lg">
        <div class="container">
            <div class="row">
                <div class="col-3 align-self-center">
                    <div class="header-logo py-4" style="min-height: 100px;">
                        <a href="/">@include('layouts.partials._logo')</a>
                    </div>
                </div>


                <div class="col-6 align-self-center algolia-search">
                    <search></search>
                </div>


                <div class="col-3 text-right align-self-center px-0">
                    @guest
                        <a class="btn btn-primary" href="{{ route('login') }}"><i class="material-icons">account_box</i> Войти<div class="ripple-container"></div></a>
                        @else
                            <a class="btn btn-secondary" href="{{ route('account.profile') }}"><i class="material-icons">account_box</i> Кабинет<div class="ripple-container"></div></a>
                            <button type="button" class="btn btn-secondary btn-simple btn-fab" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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

</header>

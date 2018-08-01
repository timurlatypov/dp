<header>
    <section class="bg-dark">
        <div class="container">
            <div class="row d-flex justify-content-between align-items-center header-top-line">
                <div class="pl-2"><h6><i class="fa fa-gift"></i>&nbsp;&nbsp;ПРОГРАММА ЛОЯЛЬНОСТИ</h6></div>
                <div class=""><h6><i class="fa fa-truck"></i>&nbsp;&nbsp;БЕСПЛАТНАЯ ДОСТАВКА ОТ 3000р.</h6></div>
                <div class=""><h6><i class="fa fa-user-md"></i>&nbsp;&nbsp;КОНСУЛЬТАЦИЯ КОСМЕТОЛОГА</h6></div>
                <div class=""><h6><a class="text-white" href="https://api.whatsapp.com/send?phone=79654433130" data-toggle="tooltip" data-placement="bottom" title="Написать в Whatsapp"><i class="fab fa-whatsapp fa-lg"></i>&nbsp;&nbsp;<b>8 (965) 443-31-30</b></a></h6></div>
                <div class="pr-2"><h6><a class="text-white" href="tel:84953801141"><i class="fa fa-phone-volume fa-lg"></i>&nbsp;&nbsp;<b>8 (495) 380-11-41</b></a></h6></div>
            </div>
        </div>
    </section>
    <section class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-3 align-self-center">
                    <div class="header-logo py-4" style="min-height: 100px;">
                        <a href="/">@include('layouts.partials._logo')</a>
                    </div>
                </div>
                <div class="col-6 align-self-center">
                    <form class="form-inline pt-3">
                        <div class="form-group bmd-form-group pt-0 ">
                            <input type="text" class="form-control" placeholder="поиск">
                        </div>
                        <button type="submit" class="btn btn-fab btn-round btn-white">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form>
                </div>
                <div class="col-3 text-right align-self-center px-0">
                    @guest
                        <a class="btn btn-warning" href="{{ route('login') }}"><i class="material-icons">account_box</i> Войти<div class="ripple-container"></div></a>
                        @else
                        <a class="btn btn-warning" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">account_box</i> Выйти<div class="ripple-container"></div></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </section>
</header>

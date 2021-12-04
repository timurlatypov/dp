<nav class="navbar sticky-top navbar-expand-lg" id="sectionsNav">
    <div class="container-fluid">

        <div class="navbar-translate">

            <div class="show-lg">
                <cart-mobile :cart_items="{{ $cart }}" cart_count="{{ $cart->count() }}"></cart-mobile>
            </div>
            <div class="nav-logo show-lg">
                <a href="/">@include('layouts.partials._logo')</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">

                @guest
                    <a class="btn btn-primary btn-sm show-lg m-3" href="{{ route('login') }}"><i class="material-icons">account_box</i> Войти<div class="ripple-container"></div></a>
                @else
                    <a class="btn btn-primary btn-sm show-lg m-3" href="{{ route('account.profile') }}"><i class="material-icons">account_box</i> Кабинет<div class="ripple-container"></div></a>
                @endguest

                <li class="nav-item">
                    <a class="nav-link text-info" href="{{ route('ny2022') }}">
                        <i class="fas fa-snowflake"></i>&nbsp;&nbsp;Новый Год 2022
                    </a>
                </li>
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('novelties') }}">Новинки</a></li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link text-danger" href="{{ route('eightMarch') }}">--}}
{{--                        <i class="fas fa-gift"></i>&nbsp;&nbsp;8 Марта--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link text-warning" href="{{ route('premium') }}">
                        <i class="fas fa-crown"></i>&nbsp;&nbsp;Премиум
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="/brand/sets">Наборы</a></li>
                <li class="dropdown nav-item">
                    <a class="nav-link" href="#" data-toggle="dropdown">Для женщин</a>
                    <div class="dropdown-menu">
                        <div class="megamenu mx-md-3 my-md-2">
                            <div style="min-width: 200px;">
                                <h4 class="title my-0 px-3 px-md-4 mt-md-4 mb-md-2"><nobr>Для лица</nobr></h4>
                                @foreach($for_face->subcategories as $subcategory)
                                    <a class="dropdown-item{{ request()->is('category/for-face/'.$subcategory->slug) ? ' active' : '' }}" href="{{ route('show.category.subcategory', [$for_face, $subcategory]) }}">{{ $subcategory->name }}</a>
                                @endforeach
                            </div>
                            <div style="min-width: 200px">
                                <h4 class="title my-0 px-3 px-md-4 mt-md-4 mb-md-2"><nobr>Для тела</nobr></h4>
                                @foreach($for_body->subcategories as $subcategory)
                                    <a class="dropdown-item{{ request()->is('category/for-body/'.$subcategory->slug) ? ' active' : '' }}" href="{{ route('show.category.subcategory', [$for_body, $subcategory]) }}">{{ $subcategory->name }}</a>
                                @endforeach
                            </div>
                            <div style="min-width: 200px;">
                                <h4 class="title my-0 px-3 px-md-4 mt-md-4 mb-md-2"><nobr>Направленный уход</nobr></h4>
                                @foreach($direct_care->subcategories as $subcategory)
                                    <a class="dropdown-item{{ request()->is('category/direct-care/'.$subcategory->slug) ? ' active' : '' }}" href="{{ route('show.category.subcategory', [$direct_care, $subcategory]) }}">{{ $subcategory->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('show.category', 'for-men') }}">Для мужчин</a></li>
{{--                <li class="nav-item"><a class="nav-link" href="{{ route('show.category', 'for-kids') }}">Для детей</a></li>--}}
                <li class="nav-item"><a class="nav-link" href="{{ route('show.category', 'for-hair') }}">Для волос</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="{{ route('discounts') }}">Скидки</a></li>

                <li class="dropdown nav-item">
                    <a class="nav-link" href="#" data-toggle="dropdown">Бренды</a>
                    <div class="dropdown-menu dropdown-with-icons">
                       @foreach($brands as $brand)
                        <a class="dropdown-item small" href="{{ route('show.brand.products', $brand) }}">{{ $brand->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="/delivery">Доставка и оплата</a></li>
                <li class="nav-item"><a class="nav-link" href="/contacts">Контакты</a></li>
                <li class="nav-item"><a class="nav-link text-info" href="/bookmarks">Избранное</a></li>
                <cart :cart_items="{{ $cart }}" cart_count="{{ $cart->count() }}"></cart>
                    @guest
                    @else
                        <button type="button" class="btn btn-default btn-sm show-lg m-3" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="material-icons">exit_to_app</i> Выйти
                        </button>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar sticky-top navbar-expand-lg" id="sectionsNav">
    <div class="container-fluid">
        <div class="navbar-translate">
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('novelties') }}">Новинки</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('bestsellers') }}">Бестселлеры</a></li>
                <li class="dropdown nav-item">
                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Уход за кожей</a>
                    <div class="dropdown-menu">
                        <div class="megamenu mx-3 my-2">
                            <div style="min-width: 200px;">
                                <h4 class="title px-4 mt-4 mb-2"><nobr>Для лица</nobr></h4>
                                <a class="dropdown-item" href="#">Домашние пилинги</a>
                                <a class="dropdown-item" href="#">Проблемная кожа</a>
                                <a class="dropdown-item" href="#">Защита от солнца SPF</a>
                                <a class="dropdown-item" href="#">Антиоксиданты</a>
                                <a class="dropdown-item" href="#">Крема</a>
                                <a class="dropdown-item" href="#">Сыворотки</a>
                                <a class="dropdown-item" href="#">Маски</a>
                                <a class="dropdown-item" href="#">Скрабы</a>
                                <a class="dropdown-item" href="#">Косметика для глаз</a>
                                <a class="dropdown-item" href="#">Уход за ресницами</a>
                                <a class="dropdown-item" href="#">Уход за губами</a>
                                <a class="dropdown-item" href="#">Уход за волосами</a>
                            </div>
                            <div style="min-width: 200px">
                                <h4 class="title px-4 mt-4 mb-2"><nobr>Для тела</nobr></h4>
                                @foreach($for_body->subcategories as $subcategory)
                                    <a class="dropdown-item" href="{{ route('show.category.subcategory', [$for_body, $subcategory]) }}">{{ $subcategory->name }}</a>
                                    @endforeach
                            </div>
                            <div style="min-width: 200px;">
                                <h4 class="title px-4 mt-4 mb-2"><nobr>Направленный уход</nobr></h4>
                                <a class="dropdown-item" href="#">Очищающие средства</a>
                                <a class="dropdown-item" href="#">Увлажняющие средства</a>
                                <a class="dropdown-item" href="#">Тонизирующие средства</a>
                                <a class="dropdown-item" href="#">Восстанавливающие средства</a>
                                <a class="dropdown-item" href="#">Осветляющие средства</a>
                                <a class="dropdown-item" href="#">Отшелушивающие средства</a>
                                <a class="dropdown-item" href="#">Anti-Age средства</a>
                            </div>
                        </div>


                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('show.category', 'for-men') }}">Для мужчин</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('show.category', 'for-kids') }}">Для детей</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('discounts') }}">Скидки</a></li>

                <li class="dropdown nav-item">
                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Бренды</a>
                    <div class="dropdown-menu dropdown-with-icons">
                       @foreach($brands as $brand)
                        <a class="dropdown-item" href="{{ route('show.brand.products', $brand) }}">{{ $brand->name }}</a>
                        @endforeach
                    </div>
                </li>

                <li class="nav-item"><a class="nav-link" href="#">Доставка и оплата</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Контакты</a></li>
                <cart :cart_items="{{ $cart }}" cart_count="{{ $cart->count() }}"></cart>
            </ul>
        </div>
    </div>
</nav>
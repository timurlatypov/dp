<ul class="nav nav-pills nav-pills-icons px-0 py-3" role="tablist">
    <!--
        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
    -->
    <li class="nav-item">
        <a class="nav-link {{ Request::is('account/profile') ? 'active' : '' }}" href="{{ route('account.profile') }}">
            <i class="material-icons">account_circle</i>
            Профиль
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('account/addresses') ? 'active' : '' }}" href="{{ route('account.addresses') }}">
            <i class="material-icons">room</i>
            Адреса
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('account/orders') ? 'active' : '' }}" href="{{ route('account.orders') }}">
            <i class="material-icons">assignment</i>
            Заказы
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::is('account/favorite') ? 'active' : '' }}" href="{{ route('account.favorite') }}">
            <i class="material-icons">loyalty</i>
            Любимые
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Request::is('account/loyalty') ? 'active' : '' }}" href="{{ route('account.loyalty') }}">
            <i class="material-icons">star</i>
            Моя скидка
        </a>
    </li>

</ul>
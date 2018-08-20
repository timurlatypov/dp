<div class="admin-panel-logo mx-auto mt-4">
    @include('layouts.partials._logo')
    <p>{{ auth()->user()->roles->first()->name }}</p>
    <p>{{ auth()->user()->name }} {{ auth()->user()->surname }}</p>
</div>
<ul class="nav">
    <li class="nav-item">
        <a class="nav-link" href="#href">
            <i class="material-icons">dashboard</i>
            <p>Панель</p>
        </a>
    </li>

    @if(  auth()->check() && auth()->user()->hasRole(['admin']))
    <li class="nav-item">
        <a class="nav-link" href="#href">
            <i class="material-icons">supervisor_account</i>
            <p>Пользователи</p>
        </a>
    </li>
    @endif

    <li class="nav-item {{ Request::is('admin-panel/orders*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="material-icons">assignment</i>
            <p>Заказы @if($new_orders_count)<span class="badge badge-pill badge-success">{{$new_orders_count}}</span>@endif</p>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="#pablo">
            <i class="material-icons">assignment_ind</i>
            <p>Клиенты</p>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin-panel/products*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.product.index') }}">
            <i class="material-icons">shopping_cart</i>
            <p>Продукты</p>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin-panel/categories*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="material-icons">close</i>
            <p>Категории</p>
        </a>
    </li>

    @if(  auth()->check() && auth()->user()->hasRole(['admin']))
    <li class="nav-item ">
        <a class="nav-link" href="#promo">
            <i class="material-icons">confirmation_number</i>
            <p>Промокоды</p>
        </a>
    </li>
    @endif

    <li class="nav-item ">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="material-icons">exit_to_app</i> <p>Выйти</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
@component('web.general.template')

    {{--@push('carousel')--}}
        {{--@include('layouts.partials._carousel')--}}
    {{--@endpush--}}

    @slot('title')
        Программа лояльности "Любимый клиент"
    @endslot

    @slot('translate')
        'translate-top-30'
    @endslot

    @slot('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-3 hidden-sm">
                    @include('layouts.partials._in_product_nav')
                </div>
                <div class="col-12 col-sm-8 col-md-9 px-3 px-sm-3 text-justify">
                    <div class="px-5 pb-5">
                        <h4 class="title mt-0 mb-3">Любимый клиент</h4>
                        <p>ДосторПроффи ценит своих постоянных покупателей и предоставляет систему накопительной скидки. Приобретая продукцию в нашем магазине, Вы можете получить скидку, которая будет увеличиваться в зависимости от общей суммы всех заказов. Участие в программе осуществляется автоматически после <a href="/register">регистрации</a> на нашем сайте.</p>
                        <ul class="list-group">Схема расчета накопительной скидки.
                            <li class="list-group-item ml-3">3% - при регистрации на сайте</li>
                            <li class="list-group-item ml-3">5% - от 15000 руб</li>
                            <li class="list-group-item ml-3">7% - от 30000 руб</li>
                            <li class="list-group-item ml-3">10% - от 60000 руб</li>
                        </ul>
                        <p>Скидка 3% дарится при первой же покупке всем зарегистрированным покупателям. Последующие скидки присваиваются автоматически при накоплении соответствующей суммы на следующий заказ. Сумма считается накопленной, если все ваши предыдущие заказы имеют статус «Доставлен». Посмотреть статусы заказов и свою текущую скидку вы можете, зайдя в <a href="/account/profile">Личный кабинет</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    @endslot

@endcomponent
@component('web.general.template')

    @slot('title')
        Карта пунктов выдачи заказов СДЭК
    @endslot

    @slot('translate')
        'translate-top-30'
    @endslot

    @slot('script')

    @endslot

    @slot('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-3 hidden-sm">
                    @include('layouts.partials._in_product_nav')
                </div>
                <div class="col-12 col-sm-8 col-md-9 px-3 px-sm-3 text-justify">
                    <div class="px-5 pb-5">
                        <h4 class="title">Калькулятор доставки СДЕК</h4>

                        <delivery-calculator></delivery-calculator>

                    </div>
                </div>
            </div>
        </div>
    @endslot

@endcomponent

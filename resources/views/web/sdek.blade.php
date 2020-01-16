@component('web.general.template')

    @slot('title')
        Карта пунктов выдачи заказов СДЭК
    @endslot

    @slot('translate')
        'translate-top-30'
    @endslot

    @slot('script')
        <script id="ISDEKscript" type="text/javascript" src="https://widget.cdek.ru/widget/widjet.js"></script>
        <script type="text/javascript">
          var ourWidjet = new ISDEKWidjet({
            defaultCity: 'Москва',
            cityFrom: 'Москва',
            country: 'Россия',
            link: 'forpvz',
            path: 'https://widget.cdek.ru/widget/scripts/',
            servicepath: '/service.php',
            apikey: '4922898e-ea76-476e-9552-aee0e0c11f4d',
          });
        </script>
    @endslot

    @slot('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-3 hidden-sm">
                    @include('layouts.partials._in_product_nav')
                </div>
                <div class="col-12 col-sm-8 col-md-9 px-3 px-sm-3 text-justify">
                    <div class="px-5 pb-5">
                        <h4 class="title">Пункты выдачи</h4>
                        <div id="forpvz" style="width:100%; height:600px;"></div>
                    </div>
                </div>
            </div>
        </div>
    @endslot

@endcomponent

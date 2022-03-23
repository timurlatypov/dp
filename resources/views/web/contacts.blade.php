@component('web.general.template')

    {{--@push('carousel')--}}
        {{--@include('layouts.partials._carousel')--}}
    {{--@endpush--}}

    @slot('title')
    Контактная информация
    @endslot

    @slot('translate')
        'translate-top-30'
    @endslot

@slot('content')
    <div class="container-fluid">
        <div class="row pb-5">

            <div class="col-12 col-md-4">
                <div class="mx-4">
                    <h4 class="title">Реквизиты</h4>
                    <h5>ИП Данищук Ольга Игоревна</h5>

                    <h5>Адрес юридический: 125319, г. Москва, Кочновский пр-д., д.4, к.1</h5>
                    <h5>Адрес фактический: 125319, г. Москва, Кочновский пр-д., д.4, к.1</h5>
                    <h5>ИНН: 773379334675</h5>
                    <h5>ОГРНИП: 315774600011976</h5>

                    <h5>Расчетный счет: 40802810438000007417</h5>
                    <h5>ОАО «Сбербанк России»</h5>
                    <h5>БИК: 044525225</h5>

                </div>
            </div>

            <div class="col-12 col-md-4">
                    <div class="mx-4">
                        <h4 class="title">Телефоны</h4>
                        <h5><a class="text-dark" href="tel:84953801141"><i class="fa fa-phone-volume"></i>&nbsp;&nbsp;<b>8 (495) 380-11-41</b></a></h5>
                        <h5><a class="text-dark" href="https://api.whatsapp.com/send?phone=79253170148"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;<b>8 (925) 317-01-48</b></a></h5>
                        <h5 class="text-dark"><i class="far fa-clock"></i>&nbsp;&nbsp;<b>ОПЕРАТОРЫ: ПН-ПТ, 9:00 - 19:00</b></h5>
                    </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="mx-4">
                    <h4 class="title">Отдел продаж:</h4>
                    <h5><a class="text-dark" href="mailto:info@doctorproffi.ru"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;<b>info@doctorproffi.ru</b></a></h5>
                </div>
            </div>
        </div>
    </div>
@endslot

@endcomponent

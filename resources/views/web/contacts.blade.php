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
                    <h5>Индивидуальный  предприниматель Данищук  Ирина  Игоревна</h5>
                    <h5>Адрес: 125466, Москва г, Соколово-Мещерская ул., д. 31, кв. 38</h5>
                    <h5>ИНН: 771319541810</h5>
                    <h5>ОГРНИП: 323774600182844</h5>

                    <h5>Расчетный счет: 40802810901610001147</h5>
                    <h5>АО "АЛЬФА-БАНК"</h5>
                    <h5>БИК: 044525593</h5>

                </div>
            </div>

            <div class="col-12 col-md-4">
                    <div class="mx-4">
                        <h4 class="title">Телефоны</h4>
                        <h5><a class="text-dark" href="tel:84953801141" onclick="yaCounter35424225.reachGoal('phone'); return true;"><i class="fa fa-phone-volume"></i>&nbsp;&nbsp;<b>8 (495) 380-11-41</b></a></h5>
                        <h5><a class="text-dark" href="https://api.whatsapp.com/send?phone=79253170148" onclick="yaCounter35424225.reachGoal('whatsapp'); return true;"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;<b>8 (925) 317-01-48</b></a></h5>
                        <h5 class="text-dark"><i class="far fa-clock"></i>&nbsp;&nbsp;<b>ОПЕРАТОРЫ: ПН-ПТ, 9:00 - 19:00</b></h5>
                    </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="mx-4">
                    <h4 class="title">Отдел продаж:</h4>
                    <h5><a class="text-dark" href="mailto:info@doctorproffi.ru" onclick="yaCounter35424225.reachGoal('email'); return true;"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;<b>info@doctorproffi.ru</b></a></h5>
                </div>
            </div>
        </div>
    </div>
@endslot

@endcomponent

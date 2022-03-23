<footer class="bg-dark footer-color">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">

                <div class="container-fluid">
                    <div class="row pt-4 text-white text-center text-md-left">
                        <div class="col-12 col-md-3">
                            <div class="footer-logo">@include('layouts.partials._logo')</div>
                            <p class="tw-leading-none tw-pt-5">Интернет-магазин<br>профессиональной косметики</p>
                            <p>© doctorproffi.ru 2016 - {{ date('Y') }}</p>
                        </div>
                        <div class="col-12 col-md-3 hidden-md">
                            <h4 class="title text-white mt-2">Покупки</h4>
                            <p><a href="/delivery" class="text-white">Доставка и оплата</a></p>
                            <p><a href="/sdek" class="text-white">Карта пунктов выдачи</a></p>
                            <p><a href="/confidentiality" class="text-white">Конфиденциальность</a></p>
                            <br>
                            <p class="text-white">Принимаем к оплате</p>
                            <div class="payment-logo tw-pr-2 tw-py-2">
                                <img src="/svg/mir.svg" alt="">
                            </div>
                            <div class="payment-logo tw-pr-2 tw-py-2">
                                <img src="/svg/visa.svg" alt="">
                            </div>
                            <div class="payment-logo tw-pr-2 tw-py-2">
                                <img src="/svg/mastercard.svg" alt="">
                            </div>
                            <div class="payment-logo tw-pr-2 tw-py-2">
                                <img src="/svg/jcb.svg" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 hidden-md">
                            <h4 class="title text-white mt-2">Информация</h4>
                            {{--<h6><a href="/loyalty" class="text-white">Программа лояльности</a></h6>--}}
                            <p><a href="/contacts" class="text-white">Обратная связь</a></p>
{{--                            <p>Бесплатная консультация<br>--}}
{{--                                по телефону горячей линии: <a class="tw-font-bold tw-text-white" href="tel:88005006620">--}}
{{--                                    <nobr>8 (800) 500-66-20</nobr>--}}
{{--                                </a>--}}
{{--                            </p>--}}
                        </div>
                        <div class="col-12 col-md-3">
                            <h4 class="title text-white mt-2">Контакты</h4>
                            <p><a class="text-white" href="tel:84953801141"><i
                                            class="fa fa-phone-volume"></i>&nbsp;&nbsp;8 (495) 380-11-41</a></p>
                            <p><a class="text-white" href="https://api.whatsapp.com/send?phone=79253170148"><i
                                            class="fab fa-whatsapp"></i>&nbsp;&nbsp;8 (925) 317-01-48</a></p>
                            <p><i class="far fa-clock"></i>&nbsp;&nbsp;Операторы: 9:00 - 18:00</p>
                            <p><a class="text-white" href="mailto:info@doctorproffi.ru"><i
                                            class="fa fa-paper-plane"></i>&nbsp;&nbsp;info@doctorproffi.ru</a>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>

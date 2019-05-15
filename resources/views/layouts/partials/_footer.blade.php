<footer class="bg-dark footer-color">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">

                <div class="container-fluid">
                    <div class="row pt-4 text-white text-center text-md-left">
                        <div class="col-12 col-md-3">
                            <div class="footer-logo">@include('layouts.partials._logo')</div>
                            <h6>Интернет-магазин<br>профессиональной косметики</h6>
                            <h6 class="text-white">Только 100% оригинальная продукция!</h6>
                            <div class="py-2">
                                <a class="text-white" href="https://www.facebook.com/DoctorProffi.ru/" target="_blank"><i class="fab fa-facebook fa-lg pr-3"></i></a>
                                <a class="text-white" href="https://www.instagram.com/doctorproffi/" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
                            </div>
                            <h6>© doctorproffi.ru 2016 - {{ date('Y') }}</h6>
                        </div>
                        <div class="col-12 col-md-3 hidden-md">
                            <h4 class="title text-white mt-2">Покупки</h4>
                            <h6><a href="/delivery" class="text-white">Доставка и оплата</a></h6>
                            {{--<h6><a href="#" class="text-white">Возврат товара</a></h6>--}}
                            <h6><a href="/confidentiality" class="text-white">Конфиденциальность</a></h6>
                            <br>
                            <p>Принимаем к оплате</p>
                            <div class="payment-logo">
                                <img src="/svg/mir.svg" alt="">
                            </div>
                            <div class="payment-logo">
                                <img src="/svg/visa.svg" alt="">
                            </div>
                            <div class="payment-logo">
                                <img src="/svg/mastercard.svg" alt="">
                            </div>
                            <div class="payment-logo">
                                <img src="/svg/jcb.svg" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 hidden-md">
                            <h4 class="title text-white mt-2">Информация</h4>
                            {{--<h6><a href="/loyalty" class="text-white">Программа лояльности</a></h6>--}}
                            <h6><a href="/contacts" class="text-white">Обратная связь</a></h6>
                            {{--<h6><a href="#" class="text-white">Реквизиты</a></h6>--}}
                        </div>
                        <div class="col-12 col-md-3">
                            <h4 class="title text-white mt-2">Контакты</h4>
                            <h6><a class="text-white" href="tel:84953801141" onclick="yaCounter35424225.reachGoal('phone'); return true;"><i class="fa fa-phone-volume"></i>&nbsp;&nbsp;<b>8 (495) 380-11-41</b></a></h6>
                            <h6><a class="text-white" href="https://api.whatsapp.com/send?phone=79253170148" onclick="yaCounter35424225.reachGoal('whatsapp'); return true;"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;<b>8 (925) 317-01-48</b></a></h6>
                            <h6><a class="text-white" href="mailto:info@doctorproffi.ru" onclick="yaCounter35424225.reachGoal('email'); return true;"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;<b>info@doctorproffi.ru</b></a></h6>
                            <h6><i class="far fa-clock"></i>&nbsp;&nbsp;<b>ОПЕРАТОРЫ: 9:00 - 19:00</b></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
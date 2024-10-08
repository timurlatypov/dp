@component('web.general.template')

    @slot('title')
        Доставка и оплата
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
                        <h4 class="title">ДОСТАВКА ТОВАРА</h4>

                        <p>Доставка по Москве и Московской области осуществляется от 1 до 3-х рабочих дней, следующих за
                            днем оформления заказа <span class="text-danger">(суббота, воскресенье, праздничные дни - выходные)</span>.
                        </p>
                        <br>
                        <span><b>1. Доставка по Москве в пределах МКАД:</b></span>
                        <ul class="list-group">
                            <li class="list-group-item">- При заказе менее 6000 руб. доставка ПЛАТНАЯ, сумма составляет
                                400 руб.
                            </li>
                            <li class="list-group-item">- При заказе от 6000 руб. доставка осуществляется БЕСПЛАТНО.
                            </li>
                        </ul>

                        <br>
                        <span><b>2. Доставка за МКАД до 10 км:</b></span>
                        <ul class="list-group">
                            <li class="list-group-item">- При заказе менее 6000 руб стоимость доставки 500 руб.</li>
                            <li class="list-group-item">- При заказе на сумму от 6000 руб. и больше стоимость доставки
                                составляет 250 руб.
                            </li>
                        </ul>
                        <br>

                        <span><b>3. Доставка по России:</b></span>
                        <ul class="list-group">
                            <li class="list-group-item">Доставка осуществляется компанией&nbsp;<a
                                        href="https://www.cdek.ru/">СДЭК</a></li>
                            <li class="list-group-item">При заказе от 6000 руб доставка осуществляется бесплатно до пункта выдачи СДЭК</li>
                            <li class="list-group-item">Стоимость доставки определяется с помощью&nbsp;<a
                                        class="font-weight-bold" href="/sdek">Калькулятора
                                    Доставка</a></li>
                            <li class="list-group-item"><a class="font-weight-bold" href="/sdek-points">Карта пунктов выдачи
                                    заказов СДЭК</a></li>
                        </ul>

                        <br>
                        <span class="text-danger font-weight-bold">ВНИМАНИЕ<br>В случае Вашего отказа от доставленного заказа, стоимость курьерской службы должна быть оплачена.</span>

                        <br>
                        <br>
                        <h4 class="title">ОПЛАТА</h4>

                        <h5><b>1. Наличными или банковской картой курьеру.</b></h5>
                        <p>При доставке товара курьером в его присутствии проверьте комплектацию, внешний вид,
                            отсутствие внешних повреждений и т.д.
                            Если Вы решили сразу отказаться от заказа, просто передайте товар курьеру вместе с кассовым
                            чеком. При этом целостность упаковки товара должна быть сохранена.
                            Принятые косметические товары обмену и возврату не подлежат в соответствии с
                            законодательством РФ.</p>
                        <br>
                        <h5><b>2. Онлайн-оплата после подтверждения заказа.</b></h5>
                        <p>После подтверждения заказа нашим менеджером, Вы можете оплатить заказ онлайн из Личного
                            кабинета покупателя. Для этого Вам необходимо обязательно пройти процедуру регистрации на
                            нашем сайте.
                            Более подробно об онлайн оплате заказов Вам расскажет наш менеджер. Звоните!</p>
                        <br>
                        <h5><b>3. 100% предоплата при доставке по России.</b></h5>
                        <p>Предоплата через систему интернет-эквайринга АО "Альфа-Банк"</p>
                        <br>
                        <br>
                        <h4 class="title">Принимаем к оплате</h4>
                        <div class="payment-logo">
                            <img src="/svg/mir.svg" alt="">
                        </div>
                        <div class="payment-logo">
                            <img src="/svg/visa.svg" alt="">
                        </div>
                        <div class="payment-logo">
                            <img src="/svg/mastercard.svg" alt="">
                        </div>
                        <br>
                        <br>
                        <p>Услуга оплаты через интернет осуществляется в соответствии с Правилами международных платежных систем Visa, MasterCard и Платежной системы МИР на принципах соблюдения конфиденциальности и безопасности совершения платежа, для чего используются самые современные методы проверки, шифрования и передачи данных по закрытым каналам связи. Ввод данных банковской карты осуществляется на защищенной платежной странице АО «АЛЬФА-БАНК».</p>
                        <p>На странице для ввода данных банковской карты потребуется ввести данные банковской карты: номер карты, имя владельца карты, срок действия карты, трёхзначный код безопасности (CVV2 для VISA, CVC2 для MasterCard, Код Дополнительной Идентификации для МИР). Все необходимые данные пропечатаны на самой карте. Трёхзначный код безопасности — это три цифры, находящиеся на обратной стороне карты.</p>
                        <p>Далее вы будете перенаправлены на страницу Вашего банка для ввода кода безопасности, который придет к Вам в СМС. Если код безопасности к Вам не пришел, то следует обратиться в банк выдавший Вам карту.</p>
                        <br>
                        <h4 class="title">Случаи отказа в совершении платежа:</h4>
                        <ul class="list-group">
                            <li class="list-group-item">- банковская карта не предназначена для совершения платежей через интернет, о чем можно узнать, обратившись в Ваш Банк</li>
                            <li class="list-group-item">- недостаточно средств для оплаты на банковской карте. Подробнее о наличии средств на банковской карте Вы можете узнать, обратившись в банк, выпустивший банковскую карту</li>
                            <li class="list-group-item">- данные банковской карты введены неверно</li>
                            <li class="list-group-item">- истек срок действия банковской карты. Срок действия карты, как правило, указан на лицевой стороне карты (это месяц и год, до которого действительна карта). Подробнее о сроке действия карты Вы можете узнать, обратившись в банк, выпустивший банковскую карту</li>
                        </ul>
                        <p>По вопросам оплаты с помощью банковской карты и иным вопросам, связанным с работой сайта, Вы можете обращаться по следующим телефонам: 8 (495) 380-11-41, 8 (925) 317-01-48.</p>
                        <p>Предоставляемая вами персональная информация (имя, адрес, телефон, e-mail, номер банковской карты) является конфиденциальной и не подлежит разглашению. Данные вашей кредитной карты передаются только в зашифрованном виде и не сохраняются на нашем Web-сервере.</p>
                        <br>
                        <br>
                        <h4 class="title">Правила возврата товара</h4>
                        <p>При оплате картами возврат наличными денежными средствами не допускается. Порядок возврата регулируется правилами международных платежных систем.</p>
                        <p>Процедура возврата товара регламентируется статьей 26.1 федерального закона «О защите прав потребителей».</p>
                        <ul class="list-group">
                            <li class="list-group-item">- Потребитель вправе отказаться от товара в любое время до его передачи, а после передачи товара - в течение семи дней</li>
                            <li class="list-group-item">- Возврат товара надлежащего качества возможен в случае, если сохранены его товарный вид, потребительские свойства, а также документ, подтверждающий факт и условия покупки указанного товара</li>
                            <li class="list-group-item">- Потребитель не вправе отказаться от товара надлежащего качества, имеющего индивидуально-определенные свойства, если указанный товар может быть использован исключительно приобретающим его человеком</li>
                            <li class="list-group-item">- При отказе потребителя от товара продавец должен возвратить ему денежную сумму, уплаченную потребителем по договору, за исключением расходов продавца на доставку от потребителя возвращенного товара, не позднее чем через десять дней со дня предъявления потребителем соответствующего требования</li>
                        </ul>
                        <p>Для возврата денежных средств на банковскую карту необходимо заполнить «Заявление о возврате денежных средств», которое высылается по требованию компанией на электронный адрес и оправить его вместе с приложением копии паспорта по адресу info@doctorproffi.ru</p>
                        <p>Возврат денежных средств будет осуществлен на банковскую карту в течение 21 (двадцати одного) рабочего дня со дня получения «Заявление о возврате денежных средств» Компанией.</p>
                        <p>Для возврата денежных средств по операциям проведенными с ошибками необходимо обратиться с письменным заявлением и приложением копии паспорта и чеков/квитанций, подтверждающих ошибочное списание. Данное заявление необходимо направить по адресу info@doctorproffi.ru</p>
                        <p>Сумма возврата будет равняться сумме покупки. Срок рассмотрения Заявления и возврата денежных средств начинает исчисляться с момента получения Компанией Заявления и рассчитывается в рабочих днях без учета праздников/выходных дней.</p>
                    </div>
                </div>
            </div>
        </div>
    @endslot

@endcomponent

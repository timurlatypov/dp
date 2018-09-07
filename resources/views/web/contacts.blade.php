@component('web.general.template')

@slot('title')
Контактная информация
@endslot

@slot('content')
    <div class="container-fluid">
        <div class="row pb-5">
            <div class="col-12 col-md-6">
                <div class="mx-4">
                    <h4 class="title">Телефоны</h4>
                    <h5><a class="text-dark" href="tel:84953801141"><i class="fa fa-phone-volume"></i>&nbsp;&nbsp;<b>8 (495) 380-11-41</b></a></h5>
                    <h5><a class="text-dark" href="https://api.whatsapp.com/send?phone=79654433130" data-toggle="tooltip" data-placement="bottom" title="Написать в Whatsapp"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;<b>8 (965) 443-31-30</b></a></h5>
                    <h5 class="text-dark"><i class="far fa-clock"></i>&nbsp;&nbsp;<b>ОПЕРАТОРЫ: ПН-ПТ, 9:00 - 19:00</b></h5>
                </div>

            </div>

            <div class="col-12 col-md-6">
                <div class="mx-4">
                    <h4 class="title">Отдел продаж:</h4>
                    <h5><a class="text-dark" href="mailto:info@doctorproffi.ru"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;<b>info@doctorproffi.ru</b></a></h5>
                    <h5 class="text-dark pt-2"><b>Мы в социальных сетях</b></h5>
                    <div class="">
                        <a class="text-dark" href="https://www.facebook.com/DoctorProffi.ru/" target="_blank"><i class="fab fa-facebook fa-lg pr-3"></i></a>
                        <a class="text-dark" href="https://www.instagram.com/doctorproffi/" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endslot

@endcomponent
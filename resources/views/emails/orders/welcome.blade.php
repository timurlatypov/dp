@component('mail::message')
    Здравствуйте, {{ $event->name }}!
    <br><br>
    Вы успешно зарегистрировались на сайте www.doctorproffi.ru!
    <br><br>
    С уважением,<br>
    Команда {{ config('app.name') }}
@endcomponent

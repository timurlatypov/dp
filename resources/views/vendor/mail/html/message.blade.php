@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="http://94.142.139.93/storage/doctor-proffi-logo.png" width="180px">
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
                <div>
                    <a href="tel:84953801141">8 (495) 380-11-41</a>&nbsp;|&nbsp;<a href="https://api.whatsapp.com/send?phone=79654433130">8 (965) 443-31-30</a>
                    <br><br>
                    <span>&copy; {{ date('Y') }} DoctorProffi.ru</span>
                </div>
        @endcomponent
    @endslot
@endcomponent

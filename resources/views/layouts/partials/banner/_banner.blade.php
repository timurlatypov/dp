<div style="
        position: relative;
        width: 100%;
        height: 300px;
        background-image: url('/storage/banners/{{ $image_url }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: auto;
        text-align: right;
        ">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 text-right align-self-center">
                {{ $brand_image_url ?? '' }}
                {{ $category_image_url ?? '' }}
                <h6 class="py-3">{{ $brand_title ?? '' }}</h6>
            </div>
        </div>
    </div>
</div>

{{--<div id="carouselExampleIndicators" class="carousel">--}}
    {{--<div class="carousel-inner">--}}
        {{--<div class="carousel-item active" style="background-color: #000000">--}}
            {{--<a href="https://doctorproffi.ru/discounts" class="banner-mobile h-100">--}}
                {{--<div class="row h-100">--}}
                    {{--<div class="col-12 h-100 align-self-center ">--}}
                        {{--<div class="h-100 carousel-bg-image" style="background-image: url('/storage/carousel/mobile/mobile-black-friday.jpg')">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a href="https://doctorproffi.ru/discounts" class="banner-tablet h-100">--}}
                {{--<div class="row h-100">--}}
                    {{--<div class="col-12 h-100 align-self-center ">--}}
                        {{--<div class="h-100 carousel-bg-image" style="background-image: url('/storage/carousel/tablet/tablet-black-friday.jpg')">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a href="https://doctorproffi.ru/discounts" class="banner-desktop h-100">--}}
                {{--<div class="container-carousel h-100 px-0">--}}
                    {{--<div class="row h-100 carousel-bg-image" style="background-image: url('/storage/carousel/desktop/desktop-black-friday.jpg')">--}}
                        {{--<div class="col-12 align-self-center px-5">--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
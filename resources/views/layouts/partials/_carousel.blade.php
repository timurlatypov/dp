<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-inner">

        @foreach ($banners as $key =>$banner)
            <div class="carousel-item @if($key === 0) active @endif" style="background-color: {{ $banner->bg_color }}">
                <a href="{{ $banner->link }}" class="banner-mobile h-100">
                    <div class="row h-100">
                        <div class="col-12 h-100 align-self-center ">
                            <div class="h-100 carousel-bg-image"
                                 style="background-image: url({{ asset('storage/' . $banner->banner_mobile) }})">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ $banner->link }}" class="banner-desktop h-100">
                    <div class="container-carousel h-100 px-0">
                        <div class="row h-100 carousel-bg-image"
                             style="background-image: url({{ asset('storage/' . $banner->banner_desktop) }})">
                            <div class="col-12 align-self-center px-5">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

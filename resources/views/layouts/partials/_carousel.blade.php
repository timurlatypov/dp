<div id="carouselExampleIndicators" class="carousel slide">
    <ol class="carousel-indicators">
        @foreach($banners as $key => $banner)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"@if($key === 0) class="active" @endif></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($banners as $key => $banner)
            <div class="carousel-item @if($key === 0) active @endif" style="background-color: #{{ $banner->hex }}">
                <a href="{{ $banner->link }}">
                    <div class="container h-100 px-0">
                        <div class="row h-100 carousel-bg-image" style="background-image: url('/storage/carousel/{{ $banner->image_path }}')">
                            <div class="col-12 align-self-center px-5">
                                <h1 class="open-title my-1" style="ыcolor: #{{$banner->title_hex}}">{!! $banner->title !!}</h1>
                                <p style="color: #{{$banner->body_hex}}">{!! $banner->body !!}</p>
                                <h6>{{ $banner->brand }}</h6>
                                @if($banner->button !== null)<button class="btn btn-danger btn-sm">{{ $banner->button }}</button>@endif
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
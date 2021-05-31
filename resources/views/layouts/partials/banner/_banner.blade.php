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

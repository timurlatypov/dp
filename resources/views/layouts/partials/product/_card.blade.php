<div class="card card-product p-2">
    <div
        @if(isset($tooltip))
        data-toggle="tooltip"
        data-placement="top"
        title="{{ $tooltip }}"
        @endif
    >
        <a ref="{{ $link }}" href="{{ $link }}" onclick="yaCounter35424225.reachGoal('open-card'); return true;"><img class="card-img-top" src="{{ get_image_path($thumb_path) }}" alt=""></a>
        <div class="position-absolute top-0 p-2">
            <h6 class="text-muted my-1">{{ $brand_name }}</h6>
            {{ $discount }}
            {{ $new_product }}
            {{ $ph }}
        </div>
        <div class="position-absolute top-0 right-0 pr-1">
            {{ $save_bookmark }}<br>{{ $add_favorite }}
        </div>
    </div>
    <div class="card-body d-flex flex-column justify-content-between w-100">

        <div><h4 class="title my-0 pb-2"><a href="{{ $link }}" onclick="yaCounter35424225.reachGoal('open-card'); return true;" class="hover-underlined">{{ $title_eng }}</a></h4></div>

        <div>
            @if(isset($title_rus))<p class="mt-0 text-muted tw-leading-normal tw-text-xs">{{ $title_rus }}</p>@endif
            {{ $volume_full }}
            <p><small class="font-weight-bold" style="color: darkslategray">Артикул: {{ $vendor_code }}</small></p>
            {{ $wb_code }}
            {{ $ozon_code }}
            {{ $mm_code }}
            {{ $ya_code }}
            <p><small>{{ $reviews }}</small></p>
        </div>

        <div class="d-flex justify-content-between align-items-end">
            <div class="d-inline-flex">
                {{ $price }}
            </div>
            {{ $add_button }}
        </div>
    </div>
</div>

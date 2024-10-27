@component('layouts.partials.product._card')

    @slot('thumb_path')
        {{ $product->thumb_path }}
    @endslot

    @slot('brand_name')
        {{ $product->brand->name }}
    @endslot

    @slot('vendor_code')
        {{ $product->vendor_code }}
    @endslot

    @slot('wb_code')
        @if(isset($product->wb_code))<p><small class="font-weight-bold">Wildberries: {{ $product->wb_code }}</small></p> @endif
    @endslot
    @slot('ozon_code')
        @if(isset($product->ozon_code))<p><small class="font-weight-bold">Ozon: {{ $product->ozon_code }}</small></p>@endif
    @endslot
    @slot('mm_code')
        @if(isset($product->mm_code))<p><small class="font-weight-bold">МегаМаркет: {{ $product->mm_code }}</small></p>@endif
    @endslot
    @slot('ya_code')
        @if(isset($product->ya_code))<p><small class="font-weight-bold">Яндекс Маркет: {{ $product->ya_code }}</small></p>@endif
    @endslot

    @slot('volume_full')
        @if($product->volume && $product->volume_type)<small class="mb-2"><b>Объем: {{ $product->volume }} {{ $product->volume_type->name }}</b></small>@endif
    @endslot

    @slot('ph')
        @if($product->ph)<div><small class="font-weight-bold">pH: {{ $product->ph }}</small></div>@endif
    @endslot

    @slot('discount')
        @if($product->discount)
            <span class="badge badge-pill badge-danger">-{{ $product->discount }}%</span>
        @endif
    @endslot

    @slot('new_product')
        @if($product->novelty)
            <span class="badge badge-pill badge-success font-weight-bold">новинка</span>
        @endif
    @endslot

    @slot('save_bookmark')
        <save-bookmark
                endpoint="{{ route('save.product.to.bookmark', $product) }}"
                :model="{{ $product }}"
                :price_to_show="{{ $product->definePriceToShow() }}"></save-bookmark>
    @endslot

    @slot('add_favorite')
        @if(auth()->check())<add-favorite endpoint="{{ route('attach.product.to.favorite', $product) }}"></add-favorite>@endif
    @endslot

    @slot('link')
        /brand/{{$product->brand->slug}}/{{$product->slug}}
    @endslot

    @slot('tooltip')
        {{ $product->tooltip }}
    @endslot

    @slot('title_eng')
        {{ $product->title_eng }}
    @endslot

    @slot('title_rus')
        {{ $product->title_rus }}
    @endslot

    @slot('price')
        @if($product->discount)
            <div>
                <h4 class="tw-my-0 tw-font-bold tw-text-gray-700 tw-text-md"><strike>{{ $product->price }}&nbsp;<i class="fas fa-ruble-sign" style="font-size: 90%"></i></strike></h4>
                <h4 class="tw-my-0 tw-font-bold tw-text-lg text-danger">{{ $product->definePriceToShow() }}&nbsp;<i class="fas fa-ruble-sign" style="font-size: 90%"></i></h4>
            </div>
        @else
            <h4 class="title my-0 text-success tw-text-lg">{{ $product->definePriceToShow() }}&nbsp;<i class="fas fa-ruble-sign" style="font-size: 90%"></i></h4>
        @endif
    @endslot

    @slot('add_button')
        @if ($product->stock)
            <add-button endpoint="{{ route('add.product.to.cart') }}" :model="{{ $product }}" :price_to_show="{{ $product->definePriceToShow() }}" styling="btn-primary"></add-button>
        @else
            <button class="btn btn-sm font-weight-bold" disabled>Нет в наличии</button>
        @endif
    @endslot

    @slot('reviews')
        @include('layouts.partials._reviews_stars_on_card', ['rating' => $product->getAverageRating(), 'display' => $product->getProperDisplay()])
    @endslot

@endcomponent

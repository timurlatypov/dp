@component('layouts.partials.product._card')

    @slot('thumb_path')
        {{ $product->thumb_path }}
    @endslot

    @slot('brand_name')
        {{ $product->brand->name }}
    @endslot

    @slot('ph')
        @if($product->ph)<small class="font-weight-bold">pH: {{ $product->ph }}</small>@endif
    @endslot

    @slot('add_favorite')
        @if(auth()->check())<add-favorite endpoint="{{ route('attach.product.to.favorite', $product) }}"></add-favorite>@endif
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
                <h5 class="title my-0 opacity-50"><strike>{{ $product->price }} <i class="fas fa-ruble-sign fa-sm"></i></strike></h5>
                <h5 class="title my-0 text-danger">{{ $product->definePriceToShow() }} <i class="fas fa-ruble-sign fa-sm"></i></h5>
            </div>
        @else
            <h4 class="title my-0 text-success">{{ $product->definePriceToShow() }} <i class="fas fa-ruble-sign fa-sm"></i></h4>
        @endif
    @endslot

    @slot('add_button')
        <add-button endpoint="{{ route('add.product.to.cart') }}" :model="{{ $product }}" :price_to_show="{{ $product->definePriceToShow() }}"></add-button>
    @endslot

@endcomponent
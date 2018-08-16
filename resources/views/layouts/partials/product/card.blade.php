@component('layouts.partials.product._card')

    @slot('thumb_path')
        {{ $product->thumb_path }}
    @endslot

    @slot('brand_name')
        {{ $product->brand->name }}
    @endslot

    @slot('ph')
        @if($product->ph)<div><small class="font-weight-bold">pH: {{ $product->ph }}</small></div>@endif
    @endslot

    @slot('discount')
        @if($product->discount)
            <span class="badge badge-pill badge-danger font-weight-bold">-{{ $product->discount }}%</span>
        @endif
    @endslot

    @slot('new')
        @if($product->novelty)
            <span class="badge badge-pill badge-success font-weight-bold">новинка</span>
        @endif
    @endslot



    @slot('add_favorite')
        @if(auth()->check())<add-favorite endpoint="{{ route('attach.product.to.favorite', $product) }}"></add-favorite>@endif
    @endslot

    @slot('link')
        /brand/{{$product->brand->slug}}/{{$product->slug}}
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
                <h4 class="title my-0 opacity-50"><strike>{{ $product->price }} <i class="fas fa-ruble-sign fa-sm"></i></strike></h4>
                <h4 class="title my-0 text-danger">{{ $product->definePriceToShow() }} <i class="fas fa-ruble-sign fa-sm"></i></h4>
            </div>
        @else
            <h4 class="title my-0 text-success">{{ $product->definePriceToShow() }} <i class="fas fa-ruble-sign fa-sm"></i></h4>
        @endif
    @endslot

    @slot('add_button')
        <add-button endpoint="{{ route('add.product.to.cart') }}" :model="{{ $product }}" :price_to_show="{{ $product->definePriceToShow() }}"></add-button>
    @endslot

@endcomponent
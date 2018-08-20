@component('layouts.partials.banner._banner')

    @slot('image_url')
        @isset($brand)
            {{ $brand->brand_image_path }}
        @endisset

        @isset($categories)
            @if(isset($subcategory)){{$subcategory->image_path}}@else{{ $categories->image_path }}@endif
        @endisset

    @endslot

    @isset($brand)
        @slot('brand_image_url')
            <div class="brand-logo-banner"><img src="/storage/brands/{{ $brand->image_path }}" alt="Логотип {{ $brand->name }}"></div>
        @endslot
        @slot('brand_title')
            {{ $brand->title }}
        @endslot
    @endisset

    @isset($category)
        @slot('category_image_url')

        @endslot
    @endisset

@endcomponent
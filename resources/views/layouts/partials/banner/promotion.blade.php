@component('layouts.partials.banner._promotion')
    @slot('image_path')
        {{ $promotion->image_path }}
    @endslot
    @isset($promotion->webp_image_path)
        @slot('webp_image_path')
            <source srcset="{{ get_image_path($promotion->webp_image_path) }}" type="image/webp">
        @endslot
    @else
        @slot('webp_image_path')
        @endslot
    @endif
    @slot('link')
        {{ $promotion->link ?? '#' }}
    @endslot
@endcomponent

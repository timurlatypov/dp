@component('layouts.partials.banner._promotion')
    @slot('image_path')
        {{ $promotion->image_path }}
    @endslot
    @slot('link')
        {{ $promotion->link ?? '#' }}
    @endslot
@endcomponent

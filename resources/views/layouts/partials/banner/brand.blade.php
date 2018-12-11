@component('layouts.partials.banner._brand')

    @isset($brand)
        @slot('color')
            {{ $brand->color }}
        @endslot
        @slot('desktop')
            {{ $brand->banner_path_desktop }}
        @endslot
        @slot('tablet')
            {{ $brand->banner_path_tablet }}
        @endslot
        @slot('mobile')
            {{ $brand->banner_path_mobile }}
        @endslot
    @endisset


@endcomponent
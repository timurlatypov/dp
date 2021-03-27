@component('web.general.template')

    {{--@push('carousel')--}}
    {{--@include('layouts.partials._carousel')--}}
    {{--@endpush--}}

    @slot('title')
        Избранные продукты
    @endslot

    @slot('translate')
        'translate-top-30'
    @endslot

    @slot('content')
        <div class="container-fluid">
            <div class="row pb-5">
                <div class="col-12">
                    <div class="table-responsive px-5">
                    <table class="table table-shopping" width="100%" cellpadding="4px" cellspacing="2px">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 80px;"></th>
                            <th>Продукт</th>
                            <th>Цена</th>
                            <th>Скидка</th>
                            <th>Цена со скидкой</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookmarks as $product)
                            <tr>
                                <td>
                                    <div class="img-container">
                                        <img src="storage/{{ $product->options->image }}" alt="...">
                                    </div>
                                </td>

                                <td>
                                    <a class="font-weight-bold" href="/brand/{{ $product->options->brand_slug }}/{{ $product->options->product_slug }}">{{ $product->name }}</a>
                                    <br><small>{{ $product->options->title_rus }}</small><br>
                                    <small>{{ $product->options->brand }}</small>
                                </td>
                                <td>{{ $product->price }} &#x20BD;</td>
                                <td>{{ $product->options->discount }}%</td>
                                <td>{{ $product->options->discounted_price }} &#x20BD;</td>
                                <td>
                                    <a class="font-weight-bold btn btn-primary" href="/brand/{{ $product->options->brand_slug }}/{{ $product->options->product_slug }}">Смотреть</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    @endslot

@endcomponent

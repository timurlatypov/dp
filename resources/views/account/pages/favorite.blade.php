@extends('account.index')

@section('information')
    <h5 class="title mt-0 mb-3">Ваши любимые товары</h5>

    @if(count($favorites))
    <table class="table table-shopping">

        <thead>
        <tr>
            <th class="text-center" style="width: 80px;"></th>
            <th>Название</th>
            <th class="th-description">Актуальная цена</th>
            <th class="th-description"></th>
            <th class="">Действие</th>
            <th class="text-center" style="width: 60px;"></th>
        </tr>
        </thead>

        <tbody>
        @foreach($favorites as $product)

            <tr>
                <td>
                    <div class="img-container"><img src="/storage/products/thumb/{{ $product->thumb_path }}" alt=""></div>
                </td>

                <td class="td-name w-25">
                    <a href="#pablo">{{ $product->title_eng }}</a>
                    <br><small class="text-uppercase">{{ $product->brand->name }}</small>
                </td>

                <td class="w-25">{{ $product->definePriceToShow() }} &#x20BD;</td>

                <td class="td-actions w-25"></td>

                <td class="td-number">
                    <add-button endpoint="{{ route('add.product.to.cart') }}" :model="{{ $product }}" :price_to_show="{{ $product->definePriceToShow() }}"></add-button>
                </td>

                <td class="td-actions text-center">
                    <a class="btn btn-simple" href="{{ route('detach.product.from.favorite', $product) }}">
                        <i class="material-icons">close</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mx-auto p-4 text-center">
        {{ $favorites->links() }}
    </div>

    @else
        <p>У еще нет размещенных заказов</p>
    @endif


@endsection
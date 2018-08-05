<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 pt-3">

            <div class="card">
                <form class="form" method="" action="">

                    <div class="card-header card-header-warning text-center">
                        <h3 class="card-title mb-1 mt-0">Сезонное предложение</h3>
                    </div>

                    <div class="card-body d-flex flex-wrap justify-content-around">

                        @foreach($seasonal as $product)
                        <div class="card card-product p-2">
                            <div>
                                <a href="#"><img class="card-img-top" src="/storage/products/thumb/{{$product->thumb_path}}" alt=""></a>
                                <div class="position-absolute top-0 p-2"><h6 class="text-muted my-1">{{ $product->brand->name }}</h6></div>
                                <div class="position-absolute top-0 right-0 pr-1">
                                    <add-favorite endpoint="{{ route('attach.product.to.favorite', $product) }}"></add-favorite>
                                </div>
                            </div>
                            <div class="card-body w-100">
                                <h4 class="title my-0"><a href="#" class="hover-underlined">{{$product->title_eng}}</a></h4>
                                <p class="mt-0 mb-3 text-muted">{{$product->title_rus}}</p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-inline-flex">
                                        {{--<h4 class="title my-0 opacity-50"><strike>2630 <i class="fas fa-ruble-sign fa-sm"></i></strike></h4>&nbsp;&nbsp;<h4 class="title my-0 text-danger">2100 <i class="fas fa-ruble-sign fa-sm"></i></h4>--}}
                                        <h4 class="title my-0 text-danger">{{ $product->definePriceToShow() }} <i class="fas fa-ruble-sign fa-sm"></i></h4>
                                    </div>

                                    <add-button endpoint="{{ route('add.product.to.cart') }}" :model="{{ $product }}" :price_to_show="{{ $product->definePriceToShow() }}"></add-button>

                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <div class="footer text-center pb-3">
                        <a href="#pablo" class="btn btn-primary">Все предложения</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
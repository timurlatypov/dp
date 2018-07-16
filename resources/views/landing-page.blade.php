@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card">
                    <form class="form" method="" action="">
                        <div class="card-header card-header-warning text-center">
                            <h3 class="card-title mb-1 mt-0">Сезонное предложение</h3>
                        </div>
                        <div class="card-body d-flex flex-wrap justify-content-around">

                            <div class="card card-product p-2">
                                <div>
                                    <a href="#"><img class="card-img-top" src="/storage/product/thumb/Corpolibero-Flash-Repair-Cream-SPF-15-650-650.jpg" alt=""></a>
                                    <div class="position-absolute top-0 p-2"><h6 class="text-muted my-1">Corpolibero</h6></div>
                                    <div class="position-absolute top-0 right-0 pr-1">
                                        <button type="submit" class="btn btn-fab btn-link" data-toggle="tooltip" data-placement="top" title="Сохранить любимый продукт">
                                            <i class="material-icons text-danger">favorite_border</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body w-100">
                                    <h4 class="title my-0"><a href="#" class="hover-underlined">Repair Cream SPF 15</a></h4>
                                    <p class="mt-0 mb-3 text-muted">Восстанавливающий крем</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-flex">
                                            <h4 class="title my-0 opacity-50"><strike>2630 <i class="fas fa-ruble-sign fa-sm"></i></strike></h4>&nbsp;&nbsp;<h4 class="title my-0 text-danger">2100 <i class="fas fa-ruble-sign fa-sm"></i></h4>
                                        </div>
                                        <button type="submit" class="btn btn-default btn-sm">
                                            <i class="material-icons pb-1">shopping_cart</i> В корзину<div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-product p-2">
                                <div>
                                    <a href="#"><img class="card-img-top" src="/storage/product/thumb/Corpolibero-Flash-Whitening-Cream-650-650.jpg" alt=""></a>
                                    <div class="position-absolute top-0 p-2"><h6 class="text-muted my-1">Corpolibero</h6></div>
                                    <div class="position-absolute top-0 right-0 pr-1">
                                        <button type="submit" class="btn btn-fab btn-link" data-toggle="tooltip" data-placement="top" title="Сохранить любимый продукт">
                                            <i class="material-icons text-danger">favorite_border</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body w-100">
                                    <h4 class="title my-0"><a href="#" class="hover-underlined">Whitening Cream</a></h4>
                                    <p class="mt-0 mb-3 text-muted">Крем, выравнивающий цвет лица</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-flex">
                                            <h4 class="title my-0 opacity-50"><strike>3120 <i class="fas fa-ruble-sign fa-sm"></i></strike></h4>&nbsp;&nbsp;<h4 class="title my-0 text-danger">2750 <i class="fas fa-ruble-sign fa-sm"></i></h4>
                                        </div>
                                        <button type="submit" class="btn btn-default btn-sm">
                                            <i class="material-icons pb-1">shopping_cart</i> В корзину<div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-product p-2">
                                <div>
                                    <a href="#"><img class="card-img-top" src="/storage/product/thumb/Corpolibero-Reliance-Lipcode-650-650.jpg" alt=""></a>
                                    <div class="position-absolute top-0 p-2"><h6 class="text-muted my-1">Corpolibero</h6></div>
                                    <div class="position-absolute top-0 right-0 pr-1">
                                        <button type="submit" class="btn btn-fab btn-link" data-toggle="tooltip" data-placement="top" title="Сохранить любимый продукт">
                                            <i class="material-icons text-danger">favorite_border</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body w-100">
                                    <h4 class="title my-0"><a href="#" class="hover-underlined">LipCode</a></h4>
                                    <p class="mt-0 mb-3 text-muted">Средство по уходу за губами</p>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-flex">
                                            <h4 class="title my-0 opacity-50"><strike>1280 <i class="fas fa-ruble-sign fa-sm"></i></strike></h4>&nbsp;&nbsp;<h4 class="title my-0 text-danger">980 <i class="fas fa-ruble-sign fa-sm"></i></h4>
                                        </div>
                                        <button type="submit" class="btn btn-default btn-sm">
                                            <i class="material-icons pb-1">shopping_cart</i> В корзину<div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="footer text-center pb-3">
                            <a href="#pablo" class="btn btn-primary">Все предложения</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

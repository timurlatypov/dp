<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 pt-3">
            <div class="card">
                <form class="form" method="" action="">
                    <div class="card-header card-header-doctorproffi text-center">
                        <h3 class="card-title mb-1 mt-0">Сезонное предложение</h3>
                    </div>
                    <div class="card-body d-flex flex-wrap justify-content-around">
                        @each('layouts.partials.product.card', $seasonal, 'product')
                    </div>
                    <div class="footer text-center pb-3">
                        <a href="#pablo" class="btn btn-primary">Все предложения</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
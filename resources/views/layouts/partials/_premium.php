<div class="container translate-top-30">
    <div class="row">
        <div class="col-12 pt-3">
            <div class="card">
                <div class="card-header card-header-doctorproffi text-center">
                    <h3 class="card-title mb-1 mt-0">Премиум</h3>
                </div>
                <div class="card-body d-flex flex-wrap card-col-12">
                    @each('layouts.partials.product.card', $premium, 'product')
                </div>
                <div class="footer text-center pb-3">
                    <a href="{{ route('premium') }}" class="btn btn-primary">Все предложения</a>
                </div>
            </div>
        </div>
    </div>
</div>
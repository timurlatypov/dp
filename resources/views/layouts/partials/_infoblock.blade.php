<div class="container translate-top-30">
    <div class="row">
        <div class="col-12 pt-3">
            <div class="card">
                <div class="card-header card-header-rose text-center">
                    <h3 class="card-title mb-1 mt-0">Хиты продаж</h3>
                </div>
                <div class="card-body d-flex flex-wrap card-col-12">
                    @each('layouts.partials.product.card', $recommend, 'product')
                </div>
            </div>
        </div>
    </div>
</div>
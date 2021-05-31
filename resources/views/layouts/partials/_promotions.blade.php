@if($promotions->count())
<div class="container translate-top-30">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex flex-wrap card-col-12">
                    @each('layouts.partials.banner.promotion', $promotions, 'promotion')
                </div>
            </div>
        </div>
    </div>
</div>
@endif

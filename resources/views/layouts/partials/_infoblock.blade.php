<div class="container">
    <div class="row">
        <div class="col-12 col-md-12">


                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-12 col-md-8">
                                <div>
                                    <h2 class="title text-center mt-3 mb-0">Мы рекомендуем!</h2>
                                </div>
                                <div class="d-flex card-recommend">
                                    @each('layouts.partials.product.card', $recommend, 'product')
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="card card-blog">
                                    <div class="card-header card-header-image">
                                        <a href="#pablo">
                                            <img class="img" src="/storage/info/consultation.jpg">
                                        </a>
                                        <div class="colored-shadow" style="background-image: url('/storage/info/consultation.jpg'); opacity: 1;"></div></div><div class="card-body ">

                                        <h4 class="card-title">
                                            <a href="#pablo">Консультация косметолога</a>
                                        </h4>
                                        <p class="card-description">
                                            Наш консультант, врач косметолог-дерматолог проведет для Вас бесплатную консультацию и поможет подобрать средства, которые лучше подойдут для вашего типа кожи.
                                        </p>
                                        <div class="card-stats justify-content-center pt-3">
                                            <a href="#pablo" class="btn btn-primary"><i class="material-icons">perm_phone_msg</i>&nbsp;&nbsp;Заказать</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


        </div>
    </div>
</div>

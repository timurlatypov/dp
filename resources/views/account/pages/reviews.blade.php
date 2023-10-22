@extends('account.index')

@section('information')
    <h5 class="title">Оставьте отзыв</h5>
    @if (count($availableForReviewProducts))
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @foreach($availableForReviewProducts as $index => $product)
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <img class="align-self-start mr-3" width="64" height="64" src="/storage/{{ $product->product_preview }}">
                                    <div class="media-body">
                                        <h5 class="card-title">{{ $product->brand_name }} - {{ $product->product_title_eng }}</h5>
                                        <p class="card-text">{{ $product->product_title_rus }}</p>
                                        <button type="button" class="btn btn-sm btn-success mt-3" data-toggle="collapse" href="#collapseExample{{$index}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            Оставить отзыв
                                        </button>
                                    </div>
                                </div>
                                <div class="collapse pt-3" id="collapseExample{{$index}}">
                                    <form action="{{ route('account.review.create') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <p class="font-weight-bold">Ваша оценка</p>
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <div class="form-group row pb-0">
                                            <div class="rate">
                                                <input type="radio" id="star5" class="rate" name="stars" value="5"/>
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" id="star4" class="rate" name="stars" value="4"/>
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" class="rate" name="stars" value="3"/>
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" class="rate" name="stars" value="2">
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" class="rate" name="stars" value="1"/>
                                                <label for="star1" title="text">1 star</label>
                                            </div>
                                            @if ($errors->has('stars'))
                                                <small class="invalid-feedback">{{ $errors->first('stars') }}</small>
                                            @endif
                                        </div>
                                        <div class="form-group pt-0">
                                            <p class="font-weight-bold">Ваш отзыв</p>
                                            <textarea class="form-control {{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" rows="3" placeholder="">{{ old('comment') }}</textarea>
                                            @if ($errors->has('comment'))
                                                <small class="invalid-feedback">{{ $errors->first('comment') }}</small>
                                            @endif
                                        </div>
                                        <div class="mt-3 text-right">
                                            <button class="btn btn-sm py-2 px-3 btn-info">Отправить
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <p>У Вас нет купленных товаров, доступных для отзывов</p>
    @endif
    @if(count($productsWithReview))
        <h5 class="title">Ваши отзывы</h5>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @foreach($productsWithReview as $index => $product)
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <img class="align-self-start mr-3" width="64" height="64" src="/storage/{{ $product->product_preview }}">
                                    <div class="media-body">
                                        <h5 class="font-weight-bold">{{ $product->brand_name }} - {{ $product->product_title_eng }}</h5>
                                        <p class="card-text">{{ $product->product_title_rus }}</p>
                                        <p class="font-weight-bold pt-1">Ваша оценка</p>

                                        <div class="rated pl-0 pb-0">
                                            @for($i = 1; $i <= $product->review_rating; $i++)
                                                <input type="radio" id="star{{$i}}" class="rate" name="rating" value="5"/>
                                                <label class="star-rating-complete" title="text">{{$i}} stars</label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="p-0">
                                    <button type="button" class="btn btn-sm btn-primary mt-3" data-toggle="collapse" href="#productsWithReview{{$index}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Посмотреть отзыв
                                    </button>
                                </div>
                                <div class="collapse pt-3" id="productsWithReview{{$index}}">
                                    <form action="{{ route('account.review.delete') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <p class="pb-2"><small class="font-weight-bold">Создан: {{ date('d.m.Y', strtotime($product->review_published_at)) }}</small></p>
                                        <p>{{ $product->review_body }}</p>
                                        <div class="mt-3 text-right">
                                            <button class="btn btn-sm btn-danger py-2 px-3 btn-info">Удалить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
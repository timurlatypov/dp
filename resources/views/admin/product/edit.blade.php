@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">

                        <form class="form" method="post" action="{{ route('admin.product.update', $product) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <h4 class="title">КАРТИНКИ ПРОДУКТА</h4>

                            <div class="d-flex">
                                <div class="w-50 pr-3">
                                    <product-image-upload saved_image_path="{{ $product->thumb_path }}" handle_errors="@if($errors){{ old('thumb_path') }}@endif" store_path="products/thumb" input_name="thumb_path" slug="thumb" description="Размер: 650x650px" endpoint="{{ route('api.store.product.image') }}" class="mt-5 mb-5"></product-image-upload>
                                </div>
                                <div class="w-50 pl-3">
                                    <product-image-upload saved_image_path="{{ $product->image_path }}" handle_errors="@if($errors){{ old('image_path') }}@endif" store_path="products/image" input_name="image_path" slug="image" description="Размер: 1080x1080px" endpoint="{{ route('api.store.product.image') }}" class="mt-5 mb-5"></product-image-upload>
                                </div>
                            </div>

                            <h4 class="title">ОПИСАНИЕ ПРОДУКТА</h4>

                            <select-brand-line :brands_prop="{{ $brands }}" selected_brand_prop="{{ $product->brand->id }}" selected_line_prop="@if($product->line){{$product->line->id}}@endif" lines_endpoint="{{ route('api.get.product.lines') }}"></select-brand-line>

                            <div class="form-group pb-3">
                                <label for="title_eng"><b>Название (eng)</b></label>
                                <input type="text" class="input form-control{{ $errors->has('title_eng') ? ' is-invalid' : '' }}" name="title_eng" id="title_eng" value="{{ old('title_eng') ? old('title_eng') : $product->title_eng }}">
                                @if ($errors->has('title_eng'))
                                    <small class="invalid-feedback">{{ $errors->first('title_eng') }}</small>
                                @endif
                            </div>

                            <div class="form-group pb-3">
                                <label for="title_rus"><b>Название (rus)</b></label>
                                <input type="text" class="input form-control{{ $errors->has('title_rus') ? ' is-invalid' : '' }}" name="title_rus" id="title_rus" value="{{ old('title_rus') ? old('title_rus') : $product->title_rus }}">
                                @if ($errors->has('title_rus'))
                                    <small class="invalid-feedback">{{ $errors->first('title_rus') }}</small>
                                @endif
                            </div>

                            <div class="form-group pb-3">
                                <label for="ph"><b>Ph</b></label>
                                <input type="text" class="input form-control{{ $errors->has('ph') ? ' is-invalid' : '' }}" name="ph" id="ph" value="{{ old('ph') ? old('ph') : $product->ph }}">
                                @if ($errors->has('ph'))
                                    <small class="invalid-feedback">{{ $errors->first('ph') }}</small>
                                @endif
                            </div>

                            <div class="form-group pb-3">
                                <label for="slug"><b class="text-danger">slug</b></label>
                                <input type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="slug" value="{{ old('slug') ? old('slug') : $product->slug }}">
                                @if ($errors->has('slug'))
                                    <small class="invalid-feedback">{{ $errors->first('slug') }}</small>
                                @endif
                            </div>

                            <div class="form-group pb-3">
                                <label for="description_short"><b>Описание (Кратное)</b></label>
                                <textarea rows="5" class="input form-control{{ $errors->has('description_short') ? ' is-invalid' : '' }}" name="description_short" id="description_short">{{ old('description_short') ? old('description_short') : $product->description_short }}</textarea>
                                @if ($errors->has('description_short'))
                                    <small class="invalid-feedback">{{ $errors->first('description_short') }}</small>
                                @endif
                            </div>

                            <div class="form-group pb-3">
                                <label for="description_full"><b>Описание (Полное)</b></label>
                                <editor name="description_full" value="{{ old('description_full') ? old('description_full') : $product->description_full }}"></editor>
                                @if ($errors->has('description_full'))
                                    <small class="invalid-feedback">{{ $errors->first('description_full') }}</small>
                                @endif
                            </div>


                            <div class="form-group pt-3">
                                <div class="card">
                                    <div class="card-body">

                            <div class="form-group pt-3">
                                <h4 class="title">META ДАННЫЕ ПРОДУКТА (SEO)</h4>
                            </div>

                            <div class="form-group pb-3">
                                <label for="meta_title"><b>META Заголовок</b></label>
                                <input type="text" class="input form-control{{ $errors->has('meta_title') ? ' is-invalid' : '' }}" name="meta_title" id="meta_title" value="{{ old('meta_title') ? old('meta_title') : $product->meta_title }}">
                                @if ($errors->has('meta_title'))
                                    <small class="invalid-feedback">{{ $errors->first('meta_title') }}</small>
                                @endif
                            </div>

                            <div class="form-group pb-3">
                                <label for="meta_description"><b>META Описание</b></label>
                                <input type="text" class="form-control{{ $errors->has('meta_description') ? ' is-invalid' : '' }}" name="meta_description" id="meta_description" value="{{ old('meta_description') ? old('meta_description') : $product->meta_description }}">
                                @if ($errors->has('meta_description'))
                                    <small class="invalid-feedback">{{ $errors->first('meta_description') }}</small>
                                @endif
                            </div>

                            <div class="form-group pb-3">
                                <label for="meta_keywords"><b>META Ключевые слова</b></label>
                                <input type="text" class="form-control{{ $errors->has('meta_keywords') ? ' is-invalid' : '' }}" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') ? old('meta_keywords') : $product->meta_keywords }}">
                                @if ($errors->has('meta_keywords'))
                                    <small class="invalid-feedback">{{ $errors->first('meta_keywords') }}</small>
                                @endif
                            </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group pt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="title">ПОХОЖИЕ ПРОДУКТЫ (RELATED)</h4>
                                        <associate-products endpoint="{{route('admin.product.associate.related', $product)}}" :object="{{ $product }}" :items="@if($product->related){{ $product->related }}@else null @endif"></associate-products>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group pt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="title">КАТЕГОРИИ ПРОДУКТА</h4>
                                        @foreach($categories as $category)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="categories{{ $category->id }}" {{ $product->categories->contains($category->id) ? ' checked' : ''}}>
                                                {{ $category->name }}
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                @if($category->subcategories)
                                    <div class="pl-5">
                                        @foreach($category->subcategories as $subcategory)
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" name="subcategories[]" value="{{ $subcategory->id }}" id="subcategories{{ $subcategory->id }}" {{ $product->subcategories->contains($subcategory->id) ? ' checked' : ''}}>
                                                    {{ $subcategory->name }}
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="form-group pt-3">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
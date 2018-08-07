@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('store.new.subcategory', $category) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="slug">slug</label>
                <input name="slug" id="slug" class="input form-control">
            </div>

            <div class="form-group">
                <label for="name">name</label>
                <input name="name" class="input form-control">
            </div>
            <div class="form-group">
                <label for="title">title</label>
                <input name="title" class="input form-control">
            </div>
            <div class="form-group">
                <label for="image_path">image_path</label>
                <input name="image_path" class="input form-control">
            </div>
            <div class="form-group">
                <label for="body"></label>
                <textarea name="body" class="input form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
        </form>
    </div>
</div>
@endsection
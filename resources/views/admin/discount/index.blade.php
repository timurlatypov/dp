@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="title">Единая скидка</h4>

                        <form action="{{ route('admin.discount.update') }}" method="POST">
                            {{ csrf_field() }}
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Бренд</th>
                                        <th>Скидка</th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <div class="form-group" style="padding-top: 0;">
                                                <select name="brand" class="form-control">
                                                    <option>Выбрать бренд</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand') == $brand->id ? 'selected' : ''  }}>{{ $brand->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            @if($errors->has('brand'))
                                                <small class="text-danger">{{ $errors->get('brand')[0] }}</small>
                                            @endif
                                        </td>
                                        <td style="vertical-align: top;">
                                            <div class="form-group" style="padding-top: 0;">
                                                <input id="discount" name="discount" type="text" class="form-control" placeholder="Скидка" value="{{ old('discount') }}">
                                            </div>
                                            @if($errors->has('discount'))
                                                <small class="text-danger">{{ $errors->get('discount')[0] }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-sm">Обновить</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
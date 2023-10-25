@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0">Редактирование товара</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <form action="{{ route('admin.order.update', $order->id) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="name_order" class="form-label">Наименование</label>
                            <input value="{{ $order->name_order }}" type="text" class="form-control" name="name_order"
                                   id="name_order" placeholder="Введите наименование товара" required="">
                            @error('name_order')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="description" class="form-label">Описание товара</label>
                            <textarea class="form-control" name="description" id="description"
                                      placeholder="Описание товара" required="">{{ $order->description }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-6">
                            <label for="exampleInputFile">Изменить изображение</label>
                            <div class="w-25 mb-2">
                            <img src="{{ url('storage/' . $order->image) }}" alt="" class="w-50">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label">Выберите изображение</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Загрузить</span>
                                </div>
                            </div>
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="category">Выберите категорию</label>
                            <select class="form-control" id="category" name="category_id">
                                @foreach($categories as $category)
                                    <option {{ $category->id == $order->category_id ? ' selected' : ''}}
                                            value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <label for="price" class="form-label">Цена товара</label>
                            <input value="{{ $order->price }}" class="form-control" name="price" id="price"
                                   placeholder="Цена товара" required="">
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-6">
                            <button class="btn btn-primary" type="submit">Обновить</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection

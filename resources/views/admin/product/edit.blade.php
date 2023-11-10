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

                <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="title" class="form-label">Наименование</label>
                            <input value="{{ $product->title }}" type="text" class="form-control" name="title"
                                   id="title" placeholder="Введите наименование товара" required="">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="description" class="form-label">Описание товара</label>
                            <textarea class="form-control" name="description" id="description"
                                      placeholder="Описание товара" required="">{{ $product->description }}</textarea>
                            @error('description')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-group col-6">
                            <label for="exampleInputFile">Изменить изображение</label>
                            <div class="w-25 mb-2">
                            <img src="{{ url('storage/' . $product->image) }}" alt="" class="w-50">
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label">Выберите изображение</label>
                                </div>
                            </div>
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label>Выберите теги</label>

                            <select name="tags[]" class="tags" multiple="multiple" data-placeholder="Выберите тег" style="width:100%">
                                @foreach($tags as $tag)
                                    <option {{ is_array( $product->tags->pluck('id')->toArray()) && in_array($tag->id, $product->tags->pluck('id')->toArray()) ? ' selected' : '' }} value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            </select>

                        </div>
                        @error('tags')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="category">Выберите категорию</label>
                            <select class="form-control" id="category" name="category_id">
                                @foreach($categories as $category)
                                    <option {{ $category->id == $product->category_id ? ' selected' : ''}}
                                            value="{{ $category->id }}">{{ $category->title }}</option>
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
                            <input value="{{ $product->price }}" class="form-control" name="price" id="price"
                                   placeholder="Цена товара" required="">
                            @error('price')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <label for="quantity" class="form-label">Количество на складе</label>
                            <input value="{{ $product->quantity }}" class="form-control" name="quantity" id="quantity"
                                   placeholder="Количество товара" required="">
                            @error('quantity')
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

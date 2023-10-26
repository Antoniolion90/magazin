@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0">Редактирование категории</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <form action="{{ route('admin.category.update', $category->id) }}" method="post" class="needs-validation" novalidate="">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="title" class="form-label">Наименование</label>
                            <input value="{{ $category->title }}" type="text" class="form-control" name="title" id="title" placeholder="Введите наименование категории" required="">
                            @error('title')
                            <p class="text-danger">Это поле необходимо для заполнения</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="description" class="form-label">Описание категории</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Описание категории" required="">{{ $category->description }}</textarea>
                            @error('description')
                            <p class="text-danger">Это поле необходимо для заполнения</p>
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

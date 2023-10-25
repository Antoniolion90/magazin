@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0">Добавление категории</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <form action="{{ route('admin.category.store') }}" method="post" class="needs-validation" novalidate="">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="category" class="form-label">Наименование</label>
                            <input value="{{ old('category') }}" type="text" class="form-control" name="category" id="category" placeholder="Введите наименование категории" required="">
                            @error('category')
                            <p class="text-danger">Это поле необходимо для заполнения</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="description" class="form-label">Описание категории</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Описание категории" required="">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-danger">Это поле необходимо для заполнения</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <button class="btn btn-primary" type="submit">Добавить</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection

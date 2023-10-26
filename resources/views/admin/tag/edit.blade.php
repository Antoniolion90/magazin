@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0">Редактирование тэга</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <form action="{{ route('admin.tag.update', $tag->id) }}" method="post" class="needs-validation" novalidate="">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="title" class="form-label">Наименование</label>
                            <input value="{{ $tag->title }}" type="text" class="form-control" name="title" id="title" placeholder="Введите наименование тэга" required="">
                            @error('title')
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

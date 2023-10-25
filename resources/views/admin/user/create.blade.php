@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0">Добавление пользователя</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <form action="{{ route('admin.user.store') }}" method="post" class="needs-validation" novalidate="">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="name" class="form-label">Имя пользователя</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" placeholder="Введите имя пользователя" required="">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="email" class="form-label">Почта пользователя</label>
                            <input value="{{ old('email') }}" type="text" class="form-control" name="email" id="email" placeholder="Введите почту пользователя" required="">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="password" class="form-label">Пароль для входа</label>
                            <input value="{{ old('password') }}" type="text" class="form-control" name="password" id="password" placeholder="Введите пароль для входа" required="">
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="role">Выберите роль</label>
                            <select class="form-control" id="role" name="role">
                                @foreach($roles as $id => $role)
                                    <option {{ $id == old('role') ? ' selected' : ''}}
                                            value="{{ $id }}">{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <p class="text-danger">{{ $message }}</p>
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

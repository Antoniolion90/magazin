@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6 d-flex align-items-center">
                        <h1 class="m-0 mr-3">{{ $product->name_order }}</h1>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="text-success m-3"><i class="nav-icon fas fa-pencil-alt"></i></a>
                        <form action="{{ route('admin.product.delete', $product->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border-0 bg-transparent m-3">
                                <i class="nav-icon fas fa-trash text-danger" role="button"></i>
                            </button>
                        </form>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>

                                        <tr>
                                            <td>ID</td>
                                            <td>{{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Наименование</td>
                                            <td>{{ $product->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Описание товара</td>
                                            <td class="text-wrap">{{ $product->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>Стоимость</td>
                                            <td class="text-wrap">{{ $product->price }}</td>
                                        </tr>
                                        <tr>
                                            <td>Категория</td>
                                            @foreach($categories as $category)
                                                @if($category->id == $product->category_id)
                                                    <td class="text-wrap">{{ $category->title }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Изображения</td>
                                            <td>
                                                <img src="{{ url('storage/' . $product->image) }}" alt="" class="w-25 mb-2">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection

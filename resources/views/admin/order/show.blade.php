@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6 d-flex align-items-center">
                        <h1 class="m-0 mr-3">{{ $order->name_order }}</h1>
                        <a href="{{ route('admin.order.edit', $order->id) }}" class="text-success m-3"><i class="nav-icon fas fa-pencil-alt"></i></a>
                        <form action="{{ route('admin.order.delete', $order->id) }}"
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
                                            <td>{{ $order->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Наименование</td>
                                            <td>{{ $order->name_order }}</td>
                                        </tr>
                                        <tr>
                                            <td>Описание категории</td>
                                            <td class="text-wrap">{{ $order->description }}</td>
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

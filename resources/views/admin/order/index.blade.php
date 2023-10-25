@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0">Заказы</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('admin.order.create') }}" class="btn btn-primary mb-3">Создать
                            товар</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Наименование</th>
                                        <th>Описание товара</th>
                                        <th>Стоимость</th>
                                        <th colspan="3">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->name_order }}</td>
                                            <td class="text-wrap">{{ $order->description }}</td>
                                            <td>{{ $order->price }}</td>
                                            <td><a href="{{ route('admin.order.show', $order->id) }}"><i
                                                        class="nav-icon fas fa-eye"></i></a></td>
                                            <td><a href="{{ route('admin.order.edit', $order->id) }}"
                                                   class="text-success"><i class="nav-icon fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.order.delete', $order->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent">
                                                        <i class="nav-icon fas fa-trash text-danger" role="button"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mb-3 col-12">{{ $orders->withQueryString()->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection

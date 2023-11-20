@extends('layouts.admin')
@section('content')
    <style>
        .status_1{
            background: gray;
            color: white;
            text-align: center;
        }
        .status_2{
            background: green;
            color: white;
            text-align: center;
        }
        .status_3{
            background: yellow;
            text-align: center;
        }
        .status_4{
            background: blue;
            color: white;
            text-align: center;
        }
    </style>
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
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Клиент</th>
                                        <th>Описание товара</th>
                                        <th>Стоимость заказа</th>
                                        <th>Стоимость доставки</th>
                                        <th>Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user_name }}</td>
                                            <td class="text-wrap">
                                                @foreach (json_decode($order->products, true) as $prod)
                                                    @foreach ($prod as $zakaz)
                                                        {{ $zakaz['title'] }} - {{ $zakaz['qty'] }} штук, по {{ $zakaz['price'] }} руб.<br/>
                                                    @endforeach
                                                @endforeach
                                            </td>
                                            <td>{{ $order->price }} руб.</td>
                                            <td>{{ $order->address_price }} руб.</td>
                                            <td><div class="status_{{ $order->payment_status }}">{{ $order->statusTitle }}</div></td>
                                        </tr>
                                    @endforeach
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

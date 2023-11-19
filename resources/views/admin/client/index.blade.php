@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="m-0">Клиенты</h1>
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
                                        <th>Имя</th>
                                        <th>Username</th>
                                        <th>Зарегестрирован</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->id }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->username }}</td>
                                            <td>{{ $client->created_at }}</td>
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

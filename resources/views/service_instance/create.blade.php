@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Service_instance</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Service_instance</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <div class ="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('service_instance.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="host_id">ID Host: </label>
                                <input type="text" maxlength="30" class="form-control" name="host_id"/>
                            </div>
                            <div class="form-group">
                                <label for="service_id">service_id: </label>
                                <input type="text" maxlength="30" class="form-control" name="service_id"/>
                            </div>
                            <div class="form-group">
                                <label for="host_ip_id">host_ip_id:</label>
                                <input type="text" maxlength="30" class="form-control" name="host_ip_id" />
                            </div>
                            <div class="form-group">
                                <label for="host_dns_id">host_dns_id: </label>
                                <input type="text" maxlength="30" class="form-control" name="host_dns_id"/>
                            </div>
                            <div class="form-group">
                                <label for="descr">descr: </label>
                                <input type="text" maxlength="30" class="form-control" name="descr"/>
                            </div>
                            <div class="form-group">
                                <label for="password_id">password_id:</label>
                                <input type="text" maxlength="30" class="form-control" name="password_id" />
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar service_instance</button>
                            <form>
                                <input type="button" class="btn btn-danger" value="Cancelar" onclick="history.back()">
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

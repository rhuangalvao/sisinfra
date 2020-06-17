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
            <h1 class="display-3">Editar Service_instance</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <div class ="card">
                <div class="card-body">
                    <form method="post" action="{{ route('service_instance.update', $service_instance->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="host_id">ID Host: </label>
                            <input type="text" maxlength="30" class="form-control" name="host_id" value="{{ $service_instance->host_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="service_id">service_id: </label>
                            <input type="text" maxlength="30" class="form-control" name="service_id" value="{{ $service_instance->service_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="host_ip_id">host_ip_id:</label>
                            <input type="text" maxlength="30" class="form-control" name="host_ip_id" value="{{ $service_instance->host_ip_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="host_dns_id">host_dns_id: </label>
                            <input type="text" maxlength="30" class="form-control" name="host_dns_id" value="{{ $service_instance->host_dns_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="descr">descr: </label>
                            <input type="text" maxlength="30" class="form-control" name="descr" value="{{ $service_instance->descr }}"/>
                        </div>
                        <div class="form-group">
                            <label for="password_id">password_id:</label>
                            <input type="text" maxlength="30" class="form-control" name="password_id" value="{{ $service_instance->password_id }}"/>
                        </div>
                        <div>
                            <input type="checkbox" id="monitoring" name="monitoring" value="{{ $service_instance->monitoring }}">
                            <label for="monitoring">monitoring</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Editar</button>
                        <form>
                            <input type="button" class="btn btn-danger" value="Cancelar" onclick="history.back()">
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Host_map</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Host_map</h1>
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
                    <form method="post" action="{{ route('host_map.update', $host_map->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="snmp_host_id">snmp_host_id:</label>
                            <input type="text" class="form-control" name="snmp_host_id" value="{{ $host_map->snmp_host_id }}" />
                        </div>
                        <div class="form-group">
                            <label for="snmp_host_remote_id">snmp_host_remote_id: </label>
                            <input type="text" maxlength="30" class="form-control" name="snmp_host_remote_id" value="{{ $host_map->snmp_host_remote_id }}"/>
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

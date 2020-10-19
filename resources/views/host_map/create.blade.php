@extends('adminlte::page')

<head>
    <title>Host_map</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Host_map</h1>
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
                        <form method="post" action="{{ route('host_map.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="host_id">host_id: </label>
                                <input type="text" maxlength="30" class="form-control" name="host_id"/>
                            </div>
                            <div class="form-group">
                                <label for="snmp_host_id">snmp_host_id: </label>
                                <input type="text" maxlength="30" class="form-control" name="snmp_host_id"/>
                            </div>
                            <div class="form-group">
                                <label for="snmp_host_remote_id">snmp_host_remote_id: </label>
                                <input type="text" maxlength="30" class="form-control" name="snmp_host_remote_id"/>
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar Host_map</button>
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

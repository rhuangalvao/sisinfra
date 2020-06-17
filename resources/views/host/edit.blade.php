@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>host</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar host</h1>
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
                    <form method="post" action="{{ route('host.update', $host->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="os_id">ID Operating System:</label>
                            <input type="text" class="form-control" name="os_id" value="{{ $host->os_id }}" />
                        </div>
                        <div class="form-group">
                            <label for="host_type_id">host_type_id: </label>
                            <input type="text" maxlength="30" class="form-control" name="host_type_id" value="{{ $host->host_type_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="status_id">status_id:</label>
                            <input type="text" maxlength="30" class="form-control" name="status_id" value="{{ $host->status_id }}" />
                        </div>
                        <div class="form-group">
                            <label for="tag">TAG: </label>
                            <input type="text" maxlength="30" class="form-control" name="tag" value="{{ $host->tag }}"/>
                        </div>
                        <div class="form-group">
                            <label for="hostname">hostname: </label>
                            <input type="text" maxlength="30" class="form-control" name="hostname" value="{{ $host->hostname }}"/>
                        </div>
                        <div class="form-group">
                            <label for="domain_suffix">domain_suffix: </label>
                            <input type="text" maxlength="30" class="form-control" name="domain_suffix" value="{{ $host->domain_suffix }}"/>
                        </div>
                        <div class="form-group">
                            <label for="descr">descrição: </label>
                            <input type="text" maxlength="30" class="form-control" name="descr" value="{{ $host->descr }}"/>
                        </div>
                        <div class="form-group">
                            <label for="obs">obs: </label>
                            <input type="text" maxlength="30" class="form-control" name="obs" value="{{ $host->obs }}"/>
                        </div>
                        <div class="form-group">
                            <label for="chassis_id">chassis_id: </label>
                            <input type="text" maxlength="30" class="form-control" name="chassis_id" value="{{ $host->chassis_id }}"/>
                        </div>
                        <div>
                            <input type="checkbox" id="monitoring" name="monitoring" value="{{ $host->monitoring }}">
                            <label for="monitoring">monitoring</label>
                        </div>
                        <div>
                            <input type="checkbox" id="enabled" name="enabled" value="{{ $host->enabled }}">
                            <label for="enabled">enabled</label>
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

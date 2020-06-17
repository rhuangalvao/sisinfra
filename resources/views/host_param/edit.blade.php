@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Host_param</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Host_param</h1>
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
                    <form method="post" action="{{ route('host_param.update', $host_param->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="host_id">host_id: </label>
                            <select id="host_id" name="host_id" class="select2ex form-control">
                                <option disabled value="" selected>Nome do host_id</option>
                                @foreach($host as $h)
                                    <option value={{$h->id}}> {{$h->hostname}} </option>
                                @endforeach
                            </select>
{{--                            <input type="text" maxlength="30" class="form-control" name="host_id" value="{{ $host_param->host_id }}"/>--}}
                        </div>
                        <div class="form-group">
                            <label for="param_name">param_name: </label>
                            <input type="text" maxlength="30" class="form-control" name="param_name" value="{{ $host_param->param_name }}"/>
                        </div>
                        <div class="form-group">
                            <label for="param_value">param_value:</label>
                            <input type="text" maxlength="30" class="form-control" name="param_value" value="{{ $host_param->param_value }}" />
                        </div>
                        <div>
                            <input type="checkbox" id="enabled" name="enabled" value="{{ $host_param->enabled }}">
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

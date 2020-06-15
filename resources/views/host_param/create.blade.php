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
            <h1 class="display-3">Adicionar Host_param</h1>
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
                        <form method="post" action="{{ route('host_param.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="host_id">host_id: </label>
                                <input type="text" maxlength="30" class="form-control" name="host_id"/>
                            </div>
                            <div class="form-group">
                                <label for="param_name">param_name: </label>
                                <input type="text" maxlength="30" class="form-control" name="param_name"/>
                            </div>
                            <div class="form-group">
                                <label for="param_value">param_value:</label>
                                <input type="text" maxlength="30" class="form-control" name="param_value" />
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar host_param</button>
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

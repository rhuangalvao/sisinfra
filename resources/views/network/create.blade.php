@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Network</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Network</h1>
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
                        <form method="post" action="{{ route('network.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="network_type_id">network_type_id:</label>
                                <select id="network_type_id" name="network_type_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do network_type_id</option>
                                    @foreach($network_type as $nt)
                                        <option value={{$nt->id}}> {{$nt->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">name: </label>
                                <input type="text" maxlength="30" class="form-control" name="name"/>
                            </div>
                            <div class="form-group">
                                <label for="descr">descr: </label>
                                <input type="text" maxlength="30" class="form-control" name="descr"/>
                            </div>
                            <div class="form-group">
                                <label for="address">address: </label>
                                <input type="text" maxlength="30" class="form-control" name="address"/>
                            </div>
                            <div class="form-group form-check">
                                <input type="hidden" name="enabled" value="off">
                                <input type="checkbox" class="form-check-input" name="enabled">
                                <label class="form-check-label" for="enabled">enabled</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar network</button>
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
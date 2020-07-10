@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Host_ip</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Host_ip</h1>
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
                        <form method="post" action="{{ route('host_ip.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="host_id">ID Host: </label>
                                <select id="host_id" name="host_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do host_id</option>
                                    @foreach($host as $h)
                                        <option value={{$h->id}}> {{$h->hostname}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="host_id"/>--}}
                            </div>
                            <div class="form-group">
                                <label for="ip_address">ip_address: </label>
                                <input type="text" maxlength="30" class="form-control" name="ip_address"/>
                            </div>
                            <div class="form-group">
                                <label for="mask">mask:</label>
                                <input type="text" maxlength="30" class="form-control" name="mask" />
                            </div>
                            <div class="form-group">
                                <label for="gateway">gateway: </label>
                                <input type="text" maxlength="30" class="form-control" name="gateway"/>
                            </div>
                            <div class="form-group">
                                <label for="version">version: </label>
                                <input type="text" maxlength="30" class="form-control" name="version"/>
                            </div>
                            <div class="form-group">
                                <label for="mac_address">mac_address:</label>
                                <input type="text" maxlength="30" class="form-control" name="mac_address"/>
                            </div>
                            <div class="form-group form-check">
                                <input type="hidden" name="is_main" value="off">
                                <input type="checkbox" class="form-check-input" name="is_main">
                                <label class="form-check-label" for="is_main">is_main</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar Host_ip</button>
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

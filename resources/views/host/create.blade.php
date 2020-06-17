@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Host</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Host</h1>
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
                        <form method="post" action="{{ route('host.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="os_id">ID OperatingSystem: </label>
                                <select id="os_id" name="os_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do operating_system_id</option>
                                    @foreach($operating_system as $os)
                                        <option value={{$os->id}}> {{$os->name}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="os_id"/>--}}
                            </div>
                            <div class="form-group">
                                <label for="host_type_id">Host_type_id: </label>
                                <select id="host_type_id" name="host_type_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do host_type_id</option>
                                    @foreach($host_type as $ht)
                                        <option value={{$ht->id}}> {{$ht->name}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="host_type_id"/>--}}
                            </div>
                            <div class="form-group">
                                <label for="status_id">Status_id:</label>
                                <select id="status_id" name="status_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do status_id</option>
                                    @foreach($host_status as $hs)
                                        <option value={{$hs->id}}> {{$hs->status}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="status_id" />--}}
                            </div>
                            <div class="form-group">
                                <label for="tag">TAG: </label>
                                <input type="text" maxlength="30" class="form-control" name="tag"/>
                            </div>
                            <div class="form-group">
                                <label for="hostname">hostname: </label>
                                <input type="text" maxlength="30" class="form-control" name="hostname"/>
                            </div>
                            <div class="form-group">
                                <label for="domain_suffix">domain_suffix: </label>
                                <input type="text" maxlength="30" class="form-control" name="domain_suffix"/>
                            </div>
                            <div class="form-group">
                                <label for="descr">descrição: </label>
                                <input type="text" maxlength="30" class="form-control" name="descr"/>
                            </div>
                            <div class="form-group">
                                <label for="obs">obs: </label>
                                <input type="text" maxlength="30" class="form-control" name="obs"/>
                            </div>
                            <div class="form-group">
                                <label for="chassis_id">chassis_id: </label>
                                <input type="text" maxlength="30" class="form-control" name="chassis_id"/>
                            </div>
                            <div>
                                <input type="checkbox" id="monitoring" name="monitoring">
                                <label for="monitoring">monitoring</label>
                            </div>
                            <div>
                                <input type="checkbox" id="enabled" name="enabled">
                                <label for="enabled">enabled</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar Host</button>
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

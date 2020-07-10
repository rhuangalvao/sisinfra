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
                                <select id="host_id" name="host_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do host_id</option>
                                    @foreach($host as $h)
                                        <option value={{$h->id}}> {{$h->hostname}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="host_id"/>--}}
                            </div>
                            <div class="form-group">
                                <label for="service_id">service_id: </label>
                                <select id="service_id" name="service_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do service_id</option>
                                    @foreach($service as $s)
                                        <option value={{$s->id}}> {{$s->name}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="service_id"/>--}}
                            </div>
                            <div class="form-group">
                                <label for="host_ip_id">host_ip_id:</label>
                                <select id="host_ip_id" name="host_ip_id" class="select2ex form-control">
                                    <option disabled value="" selected>Endereço do host_ip_id</option>
                                    @foreach($host_ip as $hi)
                                        <option value={{$hi->id}}> {{$hi->ip_address}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="host_ip_id" />--}}
                            </div>
                            <div class="form-group">
                                <label for="host_dns_id">host_dns_id: </label>
                                <select id="host_dns_id" name="host_dns_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do host_dns_id</option>
                                    @foreach($host_dns as $hd)
                                        <option value={{$hd->id}}> {{$hd->name}} </option>
                                    @endforeach
                                </select>
{{--                                <input type="text" maxlength="30" class="form-control" name="host_dns_id"/>--}}
                            </div>
                            <div class="form-group">
                                <label for="descr">descr: </label>
                                <input type="text" maxlength="30" class="form-control" name="descr"/>
                            </div>
                            <div class="form-group">
                                <label for="password_id">password_id:</label>
                                <input type="text" maxlength="30" class="form-control" name="password_id" />
                            </div>

                            <div class="form-group form-check">
                                <input type="hidden" name="monitoring" value="off">
                                <input type="checkbox" class="form-check-input" name="monitoring">
                                <label class="form-check-label" for="monitoring">monitoring</label>
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

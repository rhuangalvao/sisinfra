@extends('adminlte::page')
@section('plugins.Select2', true)
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/pt-BR.js"></script>

<link href="public/vendor/select2/css/select2.css" rel="stylesheet"/>
<link rel="stylesheet" href="public/vendor/select2-bootstrap4-theme/select2-bootstrap4.css">
<script src="public/vendor/select2/js/select2.js"></script>
<script>
    $(document).ready(function(){
        $('.select2ex').select2({
            // minimumInputLength: 2,
        });
    });
</script>
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
                            <label for="host_id">Host: </label>
                            <select id="host_id" name="host_id" class="select2ex form-control">
                                @foreach($host as $h)
                                    @if($service_instance->host_id == $h->id)
                                        <option value="{{ $service_instance->host_id }}" selected>{{ $h->hostname }}</option>
                                    @endif
                                @endforeach
                                @foreach($host as $h)
                                    <option value={{$h->id}}> {{$h->hostname}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service_id">service: </label>
                            <select id="service_id" name="service_id" class="select2ex form-control">
                                @foreach($service as $s)
                                    @if($service_instance->service_id == $s->id)
                                        <option value="{{ $service_instance->service_id }}" selected>{{ $s->name }}</option>
                                    @endif
                                @endforeach
                                @foreach($service as $s)
                                    <option value={{$s->id}}> {{$s->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        @if($service_instance->host_ip_id != null)
                        <div class="form-group">
                            <label for="host_ip_id">host_ip_id:</label>
                            <select id="host_ip_id" name="host_ip_id" class="select2ex form-control">
                                @foreach($host_ip as $hi)
                                    @if($service_instance->host_ip_id == $hi->id)
                                        <option value="{{ $service_instance->host_ip_id }}" selected>{{ $hi->ip_address }}</option>
                                    @endif
                                @endforeach
                                @foreach($host_ip as $hi)
                                    <option value={{$hi->id}}> {{$hi->ip_address}} </option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="host_dns_id">host_dns_id: </label>
                            <select id="host_dns_id" name="host_dns_id" class="select2ex form-control">
                                @foreach($host_dns as $hd)
                                    @if($service_instance->host_dns_id == $hd->id)
                                        <option value="{{ $service_instance->host_dns_id }}" selected>{{ $hd->name }}</option>
                                    @endif
                                @endforeach
                                @foreach($host_dns as $hd)
                                    <option value={{$hd->id}}> {{$hd->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="descr">descr: </label>
                            <input type="text" maxlength="30" class="form-control" name="descr" value="{{ $service_instance->descr }}"/>
                        </div>
                        <div class="form-group">
                            <label for="password_id">password: </label>
                            <select id="password_id" name="password_id" class="select2ex form-control">
                                @foreach($password as $pw)
                                    @if($service_instance->password_id == $pw->id)
                                        <option value="{{ $service_instance->password_id }}" selected>{{ $pw->name }}</option>
                                    @endif
                                @endforeach
                                @foreach($password as $pw)
                                    <option value={{$pw->id}}> {{$pw->name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-check">
                            <input type="hidden" name="monitoring" value="off">
                            <input type="checkbox" class="form-check-input" name="monitoring">
                            <label class="form-check-label" for="monitoring">monitoring</label>
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

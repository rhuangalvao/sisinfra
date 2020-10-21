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
                                <label for="host_id">Host: </label>
                                <select id="host_id" name="host_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do host</option>
                                    @foreach($host as $h)
                                        <option value={{$h->id}}> {{$h->hostname}} </option>
                                    @endforeach
                                </select>
                           </div>
                            <div class="form-group">
                                <label for="service_id">service: </label>
                                <select id="service_id" name="service_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do service</option>
                                    @foreach($service as $s)
                                        <option value={{$s->id}}> {{$s->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="host_ip_id">host_ip_id:</label>
                                <select id="host_ip_id" name="host_ip_id" class="select2ex form-control">
                                    <option disabled value="" selected>Endereço do host_ip</option>
                                    @foreach($host_ip as $hi)
                                        <option value={{$hi->id}}> {{$hi->ip_address}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="host_dns_id">host_dns_id: </label>
                                <select id="host_dns_id" name="host_dns_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do host_dns</option>
                                    @foreach($host_dns as $hd)
                                        <option value={{$hd->id}}> {{$hd->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="descr">descr: </label>
                                <input type="text" maxlength="30" class="form-control" name="descr"/>
                            </div>
                            <div class="form-group">
                                <label for="password_id">password: </label>
                                <select id="password_id" name="password_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do password</option>
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

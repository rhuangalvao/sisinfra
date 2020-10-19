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
                            <label for="host_id">ID Host: </label>
                            <input type="text" maxlength="30" class="form-control" name="host_id" value="{{ $service_instance->host_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="service_id">service_id: </label>
                            <input type="text" maxlength="30" class="form-control" name="service_id" value="{{ $service_instance->service_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="host_ip_id">host_ip_id:</label>
                            <input type="text" maxlength="30" class="form-control" name="host_ip_id" value="{{ $service_instance->host_ip_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="host_dns_id">host_dns_id: </label>
                            <input type="text" maxlength="30" class="form-control" name="host_dns_id" value="{{ $service_instance->host_dns_id }}"/>
                        </div>
                        <div class="form-group">
                            <label for="descr">descr: </label>
                            <input type="text" maxlength="30" class="form-control" name="descr" value="{{ $service_instance->descr }}"/>
                        </div>
                        <div class="form-group">
                            <label for="password_id">password_id:</label>
                            <input type="text" maxlength="30" class="form-control" name="password_id" value="{{ $service_instance->password_id }}"/>
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

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
    <title>Service_dependency</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Service_dependency</h1>
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
                        <form method="post" action="{{ route('service_dependency.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="service_instance_id">Service_instance: </label>
                                <select id="service_instance_id" name="service_instance_id" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do service_instance</option>
                                    @foreach($service_instance as $si)
                                        <option value={{$si->id}}> {{$si->descr}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="service_instance_id_dep">Service_instance_dep: </label>
                                <select id="service_instance_id_dep" name="service_instance_id_dep" class="select2ex form-control">
                                    <option disabled value="" selected>Nome do service_instance_dep</option>
                                    @foreach($service_instance as $si)
                                        <option value={{$si->id}}> {{$si->descr}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar Service_dependency</button>
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

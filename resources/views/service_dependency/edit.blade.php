@extends('adminlte::page')
@section('plugins.Select2', true)

{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}

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
            <h1 class="display-3">Editar Service_dependency</h1>
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
                    <form method="post" action="{{ route('service_dependency.update', $service_dependency->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="service_instance_id">Service_instance_id:</label>
                            <select id="service_instance_id" name="service_instance_id" class="select2ex form-control">
                                <option disabled value="" selected>Digite o nome do service_instance</option>
                                @foreach($service_instance as $si)
                                    <option value={{$si->id}}> {{$si->descr}} </option>
                                @endforeach
                            </select>
{{--                            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="service_instance_id" value="{{ $service_dependency->service_instance_id }}" />--}}
                        </div>
                        <div class="form-group">
                            <label for="service_instance_id_dep">Service_instance_id_dep:</label>
                            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="service_instance_id_dep" value="{{ $service_dependency->service_instance_id_dep }}" />
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

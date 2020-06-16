@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
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
                            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="service_instance_id" value="{{ $service_dependency->service_instance_id }}" />
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

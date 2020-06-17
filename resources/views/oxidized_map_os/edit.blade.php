@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Oxidized_map_os</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Oxidized_map_os</h1>
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
                    <form method="post" action="{{ route('oxidized_map_os.update', $oxidized_map_os->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="oxidized_instance_id">Oxidized_instance_id:</label>
                            <select id="oxidized_instance_id" name="oxidized_instance_id" class="select2ex form-control">
                                <option disabled value="" selected>Nome do oxidized_instance</option>
                                @foreach($oxidized_instance as $oi)
                                    <option value={{$oi->id}}> {{$oi->name}} </option>
                                @endforeach
                            </select>
{{--                            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="oxidized_instance_id" value="{{ $oxidized_map_os->oxidized_instance_id }}" />--}}
                        </div>
                        <div class="form-group">
                            <label for="operating_system_id">Operating_system_id:</label>
                            <select id="operating_system_id" name="operating_system_id" class="select2ex form-control">
                                <option disabled value="" selected>Nome do operating_system</option>
                                @foreach($operating_system as $os)
                                    <option value={{$os->id}}> {{$os->name}} </option>
                                @endforeach
                            </select>
{{--                            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" name="operating_system_id" value="{{ $oxidized_map_os->operating_system_id }}" />--}}
                        </div>
                        <div class="form-group">
                            <label for="oxidized_os">Oxidized_os: </label>
                            <input type="text" maxlength="30" class="form-control" name="oxidized_os" value="{{ $oxidized_map_os->oxidized_os }}"/>
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

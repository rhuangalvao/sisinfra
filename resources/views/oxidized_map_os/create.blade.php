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
            <h1 class="display-3">Adicionar Oxidized_map_os</h1>
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
                        <form method="post" action="{{ route('oxidized_map_os.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="oxidized_instance_id">Oxidized_instance_id: </label>
                                <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="30" class="form-control" name="oxidized_instance_id"/>
                            </div>
                            <div class="form-group">
                                <label for="operating_system_id">Operating_system_id: </label>
                                <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="30" class="form-control" name="operating_system_id"/>
                            </div>
                            <div class="form-group">
                                <label for="oxidized_os">Oxidized_os: </label>
                                <input type="text" maxlength="30" class="form-control" name="oxidized_os"/>
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar oxidized_map_os</button>
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

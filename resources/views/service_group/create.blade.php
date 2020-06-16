@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Service_group</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Service_group</h1>
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
                        <form method="post" action="{{ route('service_group.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name: </label>
                                <input type="text" maxlength="30" class="form-control" name="name"/>
                            </div>
                            <div class="form-group">
                                <label for="descr">Descr: </label>
                                <input type="text" maxlength="30" class="form-control" name="descr"/>
                            </div>

                            <button type="submit" class="btn btn-primary">Adicionar service_group</button>
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

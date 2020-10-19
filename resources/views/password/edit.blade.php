@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Password</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Editar Password</h1>
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
                    <form method="post" action="{{ route('password.update', $password->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="username">username:</label>
                            <input type="text" class="form-control" name="username" value="{{ $password->username }}" />
                        </div>
                        <div class="form-group">
                            <label for="password">password: </label>
                            <input type="text" maxlength="30" class="form-control" name="password" value="{{ $password->password }}"/>
                        </div>
                        <div class="form-group">
                            <label for="name">name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $password->name }}" />
                        </div>
                        <div class="form-group">
                            <label for="descr">descr: </label>
                            <input type="text" maxlength="30" class="form-control" name="descr" value="{{ $password->descr }}"/>
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

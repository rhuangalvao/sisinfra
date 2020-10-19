@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Aux Mac</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Adicionar Aux Mac</h1>
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
                        <form method="post" action="{{ route('aux_mac.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="mac">mac: </label>
                                <input type="text" maxlength="30" class="form-control" name="mac"/>
                            </div>
                            <div class="form-group">
                                <label for="mfr">mfr: </label>
                                <input type="text" maxlength="30" class="form-control" name="mfr"/>
                            </div>
                            <div class="form-group">
                                <label for="mfr_short">mfr_short: </label>
                                <input type="text" maxlength="30" class="form-control" name="mfr_short"/>
                            </div>
                            <div class="form-group">
                                <label for="logo">logo: </label>
                                <input type="text" maxlength="30" class="form-control" name="logo"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar aux_mac</button>
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

@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Password</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Password'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('password.create')}}" class="btn btn-primary">Novo Password</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>username</td>
            <td>password</td>
            <td>name</td>
            <td>descr</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($password as $password)
            <tr>
                <td>{{$password->username}}</td>
                <td>{{$password->password}}</td>
                <td>{{$password->name}}</td>
                <td>{{$password->descr}}</td>
                <td>
                    <a href="{{ route('password.edit',$password->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('password.destroy', $password->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Apagar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
@endsection


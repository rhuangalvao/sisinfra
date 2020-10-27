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
        <a style="margin: 19px;" href="{{ route('password.create')}}" class="btn btn-primary">New Password</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Username</td>
            <td>Password</td>
            <td>Name</td>
            <td>Description</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($passwords as $password)
            <tr>
                <td>{{$password->username}}</td>
                <td>{{$password->password}}</td>
                <td>{{$password->name}}</td>
                <td>{{$password->descr}}</td>
                <td>
                    <a href="{{ route('password.edit',$password->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('password.destroy', $password->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    {{$passwords->links()}}
@endsection


@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Network Type</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Network Type'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('network_type.create')}}" class="btn btn-primary">Novo Network Type</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>name</td>
            <td>descr</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($network_type as $network_type)
            <tr>
                <td>{{$network_type->name}}</td>
                <td>{{$network_type->descr}}</td>
                <td>
                    <a href="{{ route('network_type.edit',$network_type->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('network_type.destroy', $network_type->id)}}" method="post">
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


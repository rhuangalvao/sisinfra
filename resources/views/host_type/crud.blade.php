@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host_type</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host_type'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_type.create')}}" class="btn btn-primary">Novo host_type</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>name</td>
            <td>tag_prefix</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_type as $host_type)
            <tr>
                <td>{{$host_type->name}}</td>
                <td>{{$host_type->tag_prefix}}</td>
                <td>
                    <a href="{{ route('host_type.edit',$host_type->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('host_type.destroy', $host_type->id)}}" method="post">
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


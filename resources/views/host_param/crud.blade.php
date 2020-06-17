@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host_param</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host_param'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_param.create')}}" class="btn btn-primary">Novo Host_param</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>host_id</td>
            <td>param_name</td>
            <td>param_value</td>
            <td>enabled</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_param as $host_param)
            <tr>
                <td>{{$host_param->host_id}}</td>
                <td>{{$host_param->param_name}}</td>
                <td>{{$host_param->param_value}}</td>
                <td>{{$host_param->enabled}}</td>
                <td>
                    <a href="{{ route('host_param.edit',$host_param->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('host_param.destroy', $host_param->id)}}" method="post">
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


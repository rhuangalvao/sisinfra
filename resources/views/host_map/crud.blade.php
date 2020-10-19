@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host_map</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host_map'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_map.create')}}" class="btn btn-primary">Novo Host_map</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm col-sm-8">
        <thead>
        <tr>
            <td>host_id</td>
            <td>snmp_host_id</td>
            <td>snmp_host_remote_id</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_map as $host_map)
            <tr>
                <td>{{$host_map->host_id}}</td>
                <td>{{$host_map->snmp_host_id}}</td>
                <td>{{$host_map->snmp_host_remote_id}}</td>
                <td>
                    <a href="{{ route('host_map.edit',$host_map->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('host_map.destroy', $host_map->id)}}" method="post">
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


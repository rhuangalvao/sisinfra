@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host.create')}}" class="btn btn-primary">Novo Host</a>
    </div>
    <table class="table table-striped table-active table-sm table-bordered col-sm-8 offset-sm-2">
        <thead>
        <tr>
            <td>ID Operating System</td>
            <td>host_type_id</td>
            <td>status_id</td>
            <td>tag</td>
            <td>hostname</td>
            <td>domain_suffix</td>
            <td>descr</td>
            <td>obs</td>
            <td>chassis_id</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host as $host)
            <tr>
                <td>{{$host->os_id}}</td>
                <td>{{$host->host_type_id}}</td>
                <td>{{$host->status_id}}</td>
                <td>{{$host->tag}}</td>
                <td>{{$host->hostname}}</td>
                <td>{{$host->domain_suffix}}</td>
                <td>{{$host->descr}}</td>
                <td>{{$host->obs}}</td>
                <td>{{$host->chassis_id}}</td>
                <td>
                    <a href="{{ route('host.edit',$host->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('host.destroy', $host->id)}}" method="post">
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


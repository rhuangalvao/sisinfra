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
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>OS</td>
            <td>Type</td>
            <td>Status</td>
            <td>TAG</td>
            <td>Hostname</td>
            <td>Domain_suffix</td>
            <td>Descrição</td>
            <td>Observação</td>
            <td>chassis_id</td>
            <td>Monitoring</td>
            <td>Enabled</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host as $host)
            <tr>
                @foreach($operating_system as $os)
                    @if($os->id == $host->os_id)
                        <td>{{$os->name}}</td>
                    @endif
                @endforeach
                @foreach($host_type as $ht)
                    @if($ht->id == $host->host_type_id)
                        <td>{{$ht->name}}</td>
                    @endif
                @endforeach
                @foreach($host_status as $hs)
                    @if($hs->id == $host->status_id)
                        <td>{{$hs->status}}</td>
                    @endif
                @endforeach
                <td>{{$host->tag}}</td>
                <td>{{$host->hostname}}</td>
                <td>{{$host->domain_suffix}}</td>
                <td>{{$host->descr}}</td>
                <td>{{$host->obs}}</td>
                <td>{{$host->chassis_id}}</td>
                <td>{{$host->monitoring}}</td>
                <td>{{$host->enabled}}</td>
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


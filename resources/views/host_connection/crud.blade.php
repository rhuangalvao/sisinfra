@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host_connection</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host_connection'])
    <br>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>host_interface_a</td>
            <td>host_interface_b</td>
            <td>connection_status</td>
            <td>discovery_protocol</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_connection as $host_connection)
            <tr>
                @foreach($host_interface as $hi)
                    @if($hi->id == $host_connection->host_interface_id_a)
                        <td>{{$hi->ifname}}</td>
                    @endif
                @endforeach
                @foreach($host_interface as $hi)
                    @if($hi->id == $host_connection->host_interface_id_b)
                        <td>{{$hi->ifname}}</td>
                    @endif
                @endforeach
                <td>{{$host_connection->connection_status}}</td>
                @foreach($discovery_protocol as $dp)
                    @if($dp->id == $host_connection->discovery_protocol_id)
                        <td>{{$dp->name}}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
@endsection


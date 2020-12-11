@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host Connection</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host Connection'])
    <br>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Host interface a</td>
            <td>Host interface b</td>
            <td>Connection status</td>
            <td>Discovery protocol</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_connections as $host_connection)
            <tr>
                @foreach($host_interfaces as $hi)
                    @if($hi->id == $host_connection->host_interface_id_a)
                        <td>{{$hi->ifname}}</td>
                    @endif
                @endforeach
                @foreach($host_interfaces as $hi)
                    @if($hi->id == $host_connection->host_interface_id_b)
                        <td>{{$hi->ifname}}</td>
                    @endif
                @endforeach
                <td>{{$host_connection->connection_status}}</td>
                @if($host_connection->discovery_protocol_id != null)
                    @foreach($discovery_protocols as $dp)
                        @if($dp->id == $host_connection->discovery_protocol_id)
                            <td>{{$dp->name}}</td>
                        @endif
                    @endforeach
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    {{$host_connections->links()}}
@endsection
@section('footer')
    @include('footer')
@endsection

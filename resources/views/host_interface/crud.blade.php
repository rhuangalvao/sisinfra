@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host Interface</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host Interface'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_interface.create')}}" class="btn btn-primary">New Host Interface</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Host</td>
            <td>Name</td>
            <td>Type</td>
            <td>Speed</td>
            <td>Index</td>
            <td>Oper status</td>
            <td>Alias</td>
            <td>Port ID</td>
            <td>Is mgmt</td>
            <td>Discovery protocol</td>
            <td>snmp_host_interface</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_interfaces as $host_interface)
            <tr>
                @foreach($host as $h)
                    @if($h->id == $host_interface->host_id)
                        <td>{{$h->hostname}}</td>
                    @endif
                @endforeach
                <td>{{$host_interface->ifname}}</td>
                <td>{{$host_interface->iftype}}</td>
                <td>{{$host_interface->ifspeed}}</td>
                <td>{{$host_interface->ifindex}}</td>
                <td>{{$host_interface->ifoperstatus}}</td>
                <td>{{$host_interface->ifalias}}</td>
                <td>{{$host_interface->portid}}</td>
                <td>{{$host_interface->is_mgmt}}</td>
                @foreach($discovery_protocol as $dp)
                    @if($dp->id == $host_interface->discovery_protocol_id)
                        <td>{{$dp->name}}</td>
                    @endif
                @endforeach
                @if($host_interface->snmp_host_interface_id != null)
                    @foreach($snmp_host_interface as $shi)
                        @if($shi->id == $host_interface->snmp_host_interface_id)
                            <td>{{$shi->ifname}}</td>
                        @endif
                    @endforeach
                @else
                    <td></td>
                @endif
                <td>
                    <a href="{{ route('host_interface.edit',$host_interface->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host_interface.destroy', $host_interface->id)}}" method="post">
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
    {{$host_interfaces->links()}}
@endsection
@section('footer')
    @include('footer')
@endsection

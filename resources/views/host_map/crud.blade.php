@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host map</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host map'],['variavel'=>'host_map'])
    <table align="center" class="table table-striped table-active table-sm col-sm-8">
        <thead>
        <tr>
            <th>Host</th>
            <th>snmp_host</th>
            <th>snmp_host_remote</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($host_maps as $host_map)
            <tr>
                <td>({{$host_map->host_id}}){{$host_map->hostname}}</td>
                <td>({{$host_map->snmp_host_id}}){{$host_map->sysname}}</td>
                <td>({{$host_map->snmp_host_remote_id}}){{$host_map->host_remote}}</td>
{{--                @foreach($host as $h)--}}
{{--                    @if($h->id == $host_map->host_id)--}}
{{--                        <td>{{$h->hostname}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                @foreach($snmp_host as $sh)--}}
{{--                    @if($sh->id == $host_map->snmp_host_id)--}}
{{--                        <td>{{$sh->hostname}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                @if($host_map->snmp_host_remote_id != null)--}}
{{--                    @foreach($snmp_host as $sh)--}}
{{--                        @if($sh->id == $host_map->snmp_host_remote_id)--}}
{{--                                <td>{{$sh->hostname}}</td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <td></td>--}}
{{--                @endif--}}
                <td>
                    <a href="{{ route('host_map.edit',$host_map->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host_map.destroy', $host_map->id)}}" method="post">
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
    @if(isset($dataForm))
        {{$host_maps->appends($dataForm)->links()}}
    @else
        {{$host_maps->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

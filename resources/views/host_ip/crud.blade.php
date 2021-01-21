@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host IP</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host IP'],['variavel'=>'host_ip'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Host</th>
            <th>IP address</th>
            <th>Mask</th>
            <th>Gateway</th>
            <th>Version</th>
            <th>Mac address</th>
            <th>Is main</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($host_ips as $host_ip)
            <tr>
                <td>{{$host_ip->hostname}}</td>
{{--                @foreach($hosts as $h)--}}
{{--                    @if($h->id == $host_ip->host_id)--}}
{{--                        <td>{{$h->hostname}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$host_ip->ip_address}}</td>
                <td>{{$host_ip->mask}}</td>
                <td>{{$host_ip->gateway}}</td>
                <td>{{$host_ip->version}}</td>
                <td>{{$host_ip->mac_address}}</td>
                <td>{{$host_ip->is_main}}</td>
                <td>
                    <a href="{{ route('host_ip.edit',$host_ip->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host_ip.destroy', $host_ip->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
        @if(isset($dataForm))
            {{$host_ips->appends($dataForm)->links()}}
        @else
            {{$host_ips->links()}}
        @endif
@endsection
@section('footer')
    @include('footer')
@endsection

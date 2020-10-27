@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host IP</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host IP'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_ip.create')}}" class="btn btn-primary">New Host IP</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Host</td>
            <td>IP address</td>
            <td>Mask</td>
            <td>Gateway</td>
            <td>Version</td>
            <td>Mac address</td>
            <td>Is main</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_ips as $host_ip)
            <tr>
                @foreach($hosts as $h)
                    @if($h->id == $host_ip->host_id)
                        <td>{{$h->hostname}}</td>
                    @endif
                @endforeach
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
    <div class="container">
        {{$host_ips->links()}}
    </div>
@endsection


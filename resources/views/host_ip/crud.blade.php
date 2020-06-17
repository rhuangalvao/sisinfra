@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host_ip</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host_ip'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_ip.create')}}" class="btn btn-primary">Novo Host_ip</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>ID Host</td>
            <td>ip_address</td>
            <td>mask</td>
            <td>gateway</td>
            <td>version</td>
            <td>mac_address</td>
            <td>is_main</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_ip as $host_ip)
            <tr>
                <td>{{$host_ip->host_id}}</td>
                <td>{{$host_ip->ip_address}}</td>
                <td>{{$host_ip->mask}}</td>
                <td>{{$host_ip->gateway}}</td>
                <td>{{$host_ip->version}}</td>
                <td>{{$host_ip->mac_address}}</td>
                <td>{{$host_ip->is_main}}</td>
                <td>
                    <a href="{{ route('host_ip.edit',$host_ip->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('host_ip.destroy', $host_ip->id)}}" method="post">
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


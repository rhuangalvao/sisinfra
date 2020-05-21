@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host_dns</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host_dns'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_dns.create')}}" class="btn btn-primary">Novo Host_dns</a>
    </div>
    <table class="table table-striped table-active table-sm table-bordered col-sm-8 offset-sm-2">
        <thead>
        <tr>
            <td>ID Host</td>
            <td>Name</td>
            <td>Version</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_dns as $host_dns)
            <tr>
                <td>{{$host_dns->host_id}}</td>
                <td>{{$host_dns->name}}</td>
                <td>{{$host_dns->version}}</td>
                <td>
                    <a href="{{ route('host_dns.edit',$host_dns->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('host_dns.destroy', $host_dns->id)}}" method="post">
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


@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host_status</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host_status'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_status.create')}}" class="btn btn-primary">Novo Host_status</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Status</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_status as $host_status)
            <tr>
                <td>{{$host_status->status}}</td>
                <td>
                    <a href="{{ route('host_status.edit',$host_status->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('host_status.destroy', $host_status->id)}}" method="post">
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


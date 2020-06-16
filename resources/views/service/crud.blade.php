@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('service.create')}}" class="btn btn-primary">Novo Service</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Name</td>
            <td>Daemon_name</td>
            <td>Protocol</td>
            <td>Port</td>
            <td>Service_group_id</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($service as $service)
            <tr>
                <td>{{$service->name}}</td>
                <td>{{$service->daemon_name}}</td>
                <td>{{$service->protocol}}</td>
                <td>{{$service->port}}</td>
                <td>{{$service->service_group_id}}</td>
                <td>
                    <a href="{{ route('service.edit',$service->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('service.destroy', $service->id)}}" method="post">
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


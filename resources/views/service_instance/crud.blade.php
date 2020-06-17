@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service_instance</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service_instance'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('service_instance.create')}}" class="btn btn-primary">Novo Service_instance</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>ID Host</td>
            <td>service_id</td>
            <td>host_ip_id</td>
            <td>host_dns_id</td>
            <td>descr</td>
            <td>password_id</td>
            <td>monitoring</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($service_instance as $service_instance)
            <tr>
                <td>{{$service_instance->host_id}}</td>
                <td>{{$service_instance->service_id}}</td>
                <td>{{$service_instance->host_ip_id}}</td>
                <td>{{$service_instance->host_dns_id}}</td>
                <td>{{$service_instance->descr}}</td>
                <td>{{$service_instance->password_id}}</td>
                <td>{{$service_instance->monitoring}}</td>
                <td>
                    <a href="{{ route('service_instance.edit',$service_instance->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('service_instance.destroy', $service_instance->id)}}" method="post">
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


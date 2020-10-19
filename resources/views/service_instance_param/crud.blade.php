@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service_instance_param</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service_instance_param'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('service_instance_param.create')}}" class="btn btn-primary">Novo service_instance_param</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>service_instance</td>
            <td>param_name</td>
            <td>param_value</td>
            <td>enabled</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($service_instance_param as $service_instance_param)
            <tr>
                @foreach($service_instance as $si)
                    @if($si->id == $service_instance_param->service_instance_id)
                        <td>{{$si->descr}}</td>
                    @endif
                @endforeach
                <td>{{$service_instance_param->param_name}}</td>
                <td>{{$service_instance_param->param_value}}</td>
                <td>{{$service_instance_param->enabled}}</td>
                <td>
                    <a href="{{ route('service_instance_param.edit',$service_instance_param->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('service_instance_param.destroy', $service_instance_param->id)}}" method="post">
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


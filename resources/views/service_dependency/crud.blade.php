@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service_dependency</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service_dependency'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('service_dependency.create')}}" class="btn btn-primary">Novo Service_dependency</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Service_instance_id</td>
            <td>Service_instance_id_dep</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($service_dependency as $service_dependency)
            <tr>
                <td>{{$service_dependency->service_instance_id}}</td>
                <td>{{$service_dependency->service_instance_id_dep}}</td>
                <td>
                    <a href="{{ route('service_dependency.edit',$service_dependency->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('service_dependency.destroy', $service_dependency->id)}}" method="post">
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


@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service_group</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service_group'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('service_group.create')}}" class="btn btn-primary">Novo Service_group</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Name</td>
            <td>Descr</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($service_group as $service_group)
            <tr>
                <td>{{$service_group->name}}</td>
                <td>{{$service_group->descr}}</td>
                <td>
                    <a href="{{ route('service_group.edit',$service_group->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('service_group.destroy', $service_group->id)}}" method="post">
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


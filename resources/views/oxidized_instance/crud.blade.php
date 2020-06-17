@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Oxidized_instance</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Oxidized_instance'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('oxidized_instance.create')}}" class="btn btn-primary">Novo Oxidized_instance</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Name</td>
            <td>Url</td>
            <td>enabled</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($oxidized_instance as $oxidized_instance)
            <tr>
                <td>{{$oxidized_instance->name}}</td>
                <td>{{$oxidized_instance->url}}</td>
                <td>{{$oxidized_instance->enabled}}</td>
                <td>
                    <a href="{{ route('oxidized_instance.edit',$oxidized_instance->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('oxidized_instance.destroy', $oxidized_instance->id)}}" method="post">
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


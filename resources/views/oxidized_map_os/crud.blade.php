@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Oxidized_map_os</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Oxidized_map_os'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('oxidized_map_os.create')}}" class="btn btn-primary">Novo Oxidized_map_os</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Oxidized_instance_id</td>
            <td>Operating_system_id</td>
            <td>Oxidized_os</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($oxidized_map_os as $oxidized_map_os)
            <tr>
                <td>{{$oxidized_map_os->oxidized_instance_id}}</td>
                <td>{{$oxidized_map_os->operating_system_id}}</td>
                <td>{{$oxidized_map_os->oxidized_os}}</td>
                <td>
                    <a href="{{ route('oxidized_map_os.edit',$oxidized_map_os->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('oxidized_map_os.destroy', $oxidized_map_os->id)}}" method="post">
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


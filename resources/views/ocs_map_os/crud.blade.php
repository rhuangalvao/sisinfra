@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Ocs_map_os</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Ocs_map_os'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('ocs_map_os.create')}}" class="btn btn-primary">Novo Ocs_map_os</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Operating_system_id</td>
            <td>Ocs_os_name_match</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($operating_system as $operating_system)
            <tr>
                <td>{{$ocs_map_os->operating_system_id}}</td>
                <td>{{$ocs_map_os->ocs_os_name_match}}</td>
                <td>
                    <a href="{{ route('ocs_map_os.edit',$ocs_map_os->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('ocs_map_os.destroy', $ocs_map_os->id)}}" method="post">
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


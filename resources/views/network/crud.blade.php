@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Network</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Network'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('network.create')}}" class="btn btn-primary">Novo network</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>network_type</td>
            <td>name</td>
            <td>descr</td>
            <td>address</td>
            <td>enabled</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($network as $network)
            <tr>
                @foreach($network_type as $nt)
                    @if($nt->id == $network->network_type_id)
                        <td>{{$nt->name}}</td>
                    @endif
                @endforeach
                <td>{{$network->name}}</td>
                <td>{{$network->descr}}</td>
                <td>{{$network->address}}</td>
                <td>{{$network->enabled}}</td>
                <td>
                    <a href="{{ route('network.edit',$network->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('network.destroy', $network->id)}}" method="post">
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


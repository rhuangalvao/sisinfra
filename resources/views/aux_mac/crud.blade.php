@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Aux Mac</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Aux Mac'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('aux_mac.create')}}" class="btn btn-primary">Novo aux_mac</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>mac</td>
            <td>mfr</td>
            <td>mfr_short</td>
            <td>logo</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($aux_mac as $aux_mac)
            <tr>
                <td>{{$aux_mac->mac}}</td>
                <td>{{$aux_mac->mfr}}</td>
                <td>{{$aux_mac->mfr_short}}</td>
                <td>{{$aux_mac->logo}}</td>
                <td>
                    <a href="{{ route('aux_mac.edit',$aux_mac->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('aux_mac.destroy', $aux_mac->id)}}" method="post">
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


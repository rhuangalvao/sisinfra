@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Aux Vendor</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Aux Mac'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('aux_vendor.create')}}" class="btn btn-primary">Novo aux_vendor</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>name</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($aux_vendor as $aux_vendor)
            <tr>
                <td>{{$aux_vendor->name}}</td>
                <td>
                    <a href="{{ route('aux_vendor.edit',$aux_vendor->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('aux_vendor.destroy', $aux_vendor->id)}}" method="post">
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


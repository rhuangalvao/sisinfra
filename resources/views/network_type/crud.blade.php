@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Network Type</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Network Type'],['variavel'=>'network_type'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($network_types as $network_type)
            <tr>
                <td>{{$network_type->name}}</td>
                <td>{{$network_type->descr}}</td>
{{--                <td>--}}
{{--                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalLongoExemplo">--}}
{{--                       {{mb_strimwidth($network_type->descr, 0, 10, "...")}}--}}
{{--                    </button>--}}
{{--                </td>--}}
                <td>
                    <a href="{{ route('network_type.edit',$network_type->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('network_type.destroy', $network_type->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            <div class="modal fade" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TituloModalLongoExemplo">Description of {{$network_type->name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{$network_type->descr}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    <br/>
    @if(isset($dataForm))
        {{$network_types->appends($dataForm)->links()}}
    @else
        {{$network_types->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

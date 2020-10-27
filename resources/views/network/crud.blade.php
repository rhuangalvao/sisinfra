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
        <a style="margin: 19px;" href="{{ route('network.create')}}" class="btn btn-primary">New network</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Network type</td>
            <td>Name</td>
            <td>Description</td>
            <td>Address</td>
            <td>Enabled</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($networks as $network)
            <tr>
                @foreach($network_type as $nt)
                    @if($nt->id == $network->network_type_id)
                        <td>{{$nt->name}}</td>
                    @endif
                @endforeach
                <td>{{$network->name}}</td>
{{--                <td>{{$network->descr}}</td>--}}
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalLongoExemplo">
                        ...
                    </button>
                </td>
                <td>{{$network->address}}</td>
                <td>{{$network->enabled}}</td>
                <td>
                    <a href="{{ route('network.edit',$network->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('network.destroy', $network->id)}}" method="post">
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
                            <h5 class="modal-title" id="TituloModalLongoExemplo">Description of {{$network->name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{$network->descr}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    <br/>
    {{$networks->links()}}
@endsection


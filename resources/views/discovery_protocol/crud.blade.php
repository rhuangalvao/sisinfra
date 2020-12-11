@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Discovery Protocol</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Discovery Protocol'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('discovery_protocol.create')}}" class="btn btn-primary">New Discovery Protocol</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Name</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($discovery_protocols as $discovery_protocol)
            <tr>
                <td>{{$discovery_protocol->name}}</td>
                <td>
                    <a href="{{ route('discovery_protocol.edit',$discovery_protocol->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('discovery_protocol.destroy', $discovery_protocol->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    {{$discovery_protocols->links()}}
@endsection
@section('footer')
    @include('footer')
@endsection

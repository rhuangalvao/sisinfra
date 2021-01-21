@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host type</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host Type'],['variavel'=>'host_type'])
    <table align="center" class="table table-striped table-active table-sm col-sm-8">
        <thead>
        <tr>
            <th>Name</th>
            <th>TAG</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($host_types as $host_type)
            <tr>
                <td>{{$host_type->name}}</td>
                <td>{{$host_type->tag_prefix}}</td>
                <td>
                    <a href="{{ route('host_type.edit',$host_type->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host_type.destroy', $host_type->id)}}" method="post">
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
    @if(isset($dataForm))
        {{$host_types->appends($dataForm)->links()}}
    @else
        {{$host_types->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

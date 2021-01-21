@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Operating system</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Operating system'],['variavel'=>'operating_system'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Name</th>
            <th>Version</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($operating_systems as $operating_system)
            <tr>
                <td>{{$operating_system->name}}</td>
                <td>{{$operating_system->version}}</td>
                <td>
                    <a href="{{ route('operating_system.edit',$operating_system->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('operating_system.destroy', $operating_system->id)}}" method="post">
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
        {{$operating_systems->appends($dataForm)->links()}}
    @else
        {{$operating_systems->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

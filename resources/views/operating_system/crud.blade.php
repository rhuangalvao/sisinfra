@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Operating system</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Operating system'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('operating_system.create')}}" class="btn btn-primary">New Operating system</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Name</td>
            <td>Version</td>
            <td colspan = 2>Actions</td>
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
    {{$operating_systems->links()}}
@endsection


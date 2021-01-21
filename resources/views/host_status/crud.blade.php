@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host status</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host status'],['variavel'=>'host_status'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Status</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($host_statuses as $host_status)
            <tr>
                <td>{{$host_status->status}}</td>
                <td>
                    <a href="{{ route('host_status.edit',$host_status->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host_status.destroy', $host_status->id)}}" method="post">
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
        {{$host_statuses->appends($dataForm)->links()}}
    @else
        {{$host_statuses->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

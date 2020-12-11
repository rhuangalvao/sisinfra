@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host status</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host status'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_status.create')}}" class="btn btn-primary">New Host status</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Status</td>
            <td colspan = 2>Actions</td>
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
    {{$host_statuses->links()}}
@endsection
@section('footer')
    @include('footer')
@endsection

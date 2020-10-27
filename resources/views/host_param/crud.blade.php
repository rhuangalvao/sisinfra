@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host param</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host param'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_param.create')}}" class="btn btn-primary">New Host param</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Host</td>
            <td>Param name</td>
            <td>Param value</td>
            <td>Enabled</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_params as $host_param)
            <tr>
                @foreach($host as $h)
                    @if($h->id == $host_param->host_id)
                        <td>{{$h->hostname}}</td>
                    @endif
                @endforeach
                <td>{{$host_param->param_name}}</td>
                <td>{{$host_param->param_value}}</td>
                <td>{{$host_param->enabled}}</td>
                <td>
                    <a href="{{ route('host_param.edit',$host_param->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host_param.destroy', $host_param->id)}}" method="post">
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
    {{$host_params->links()}}
@endsection


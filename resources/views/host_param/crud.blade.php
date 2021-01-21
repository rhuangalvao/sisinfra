@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host param</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host param'],['variavel'=>'host_param'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Host</th>
            <th>Param name</th>
            <th>Param value</th>
            <th>Enabled</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($host_params as $host_param)
            <tr>
                <td>{{$host_param->hostname}}</td>
{{--                @foreach($host as $h)--}}
{{--                    @if($h->id == $host_param->host_id)--}}
{{--                        <td>{{$h->hostname}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
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
    @if(isset($dataForm))
        {{$host_params->appends($dataForm)->links()}}
    @else
        {{$host_params->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

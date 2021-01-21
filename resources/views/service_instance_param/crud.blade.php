@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service instance param</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service instance param'],['variavel'=>'service_instance_param'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Service instance</th>
            <th>Param name</th>
            <th>Param value</th>
            <th>Enabled</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($service_instance_params as $service_instance_param)
            <tr>
                <td>{{$service_instance_param->descr}}</td>
{{--                @foreach($service_instance as $si)--}}
{{--                    @if($si->id == $service_instance_param->service_instance_id)--}}
{{--                        <td>{{$si->descr}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$service_instance_param->param_name}}</td>
                <td>{{$service_instance_param->param_value}}</td>
                <td>{{$service_instance_param->enabled}}</td>
                <td>
                    <a href="{{ route('service_instance_param.edit',$service_instance_param->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('service_instance_param.destroy', $service_instance_param->id)}}" method="post">
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
        {{$service_instance_params->appends($dataForm)->links()}}
    @else
        {{$service_instance_params->links()}}
    @endif
@endsection

@section('footer')
    @include('footer')
@endsection

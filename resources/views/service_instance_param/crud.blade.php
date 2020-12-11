@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service instance param</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service instance param'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('service_instance_param.create')}}" class="btn btn-primary">New Service instance param</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Service instance</td>
            <td>Param name</td>
            <td>Param value</td>
            <td>Enabled</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($service_instance_params as $service_instance_param)
            <tr>
                @foreach($service_instance as $si)
                    @if($si->id == $service_instance_param->service_instance_id)
                        <td>{{$si->descr}}</td>
                    @endif
                @endforeach
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
    {{$service_instance_params->links()}}
@endsection

@section('footer')
    @include('footer')
@endsection

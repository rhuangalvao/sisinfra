@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('service.create')}}" class="btn btn-primary">New Service</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Name</td>
            <td>Daemon name</td>
            <td>Protocol</td>
            <td>Port</td>
            <td>Group</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <td>{{$service->name}}</td>
                <td>{{$service->daemon_name}}</td>
                <td>{{$service->protocol}}</td>
                <td>{{$service->port}}</td>
                @if($service->service_group_id!=null)
                    @foreach($service_group as $sg)
                        @if($sg->id == $service->service_group_id)
                            <td>{{$sg->name}}</td>
                        @endif
                    @endforeach
                @else
                    <td></td>
                @endif

                <td>
                    <a href="{{ route('service.edit',$service->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('service.destroy', $service->id)}}" method="post">
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
    {{$services->links()}}
@endsection
@section('footer')
    @include('footer')
@endsection

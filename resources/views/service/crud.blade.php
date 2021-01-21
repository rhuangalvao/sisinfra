@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service'],['variavel'=>'service'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Name</th>
            <th>Daemon name</th>
            <th>Protocol</th>
            <th>Port</th>
            <th>Group</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <td>{{$service->name}}</td>
                <td>{{$service->daemon_name}}</td>
                <td>{{$service->protocol}}</td>
                <td>{{$service->port}}</td>
                <td>{{$service->group_name}}</td>
{{--                @if($service->service_group_id!=null)--}}
{{--                    @foreach($service_group as $sg)--}}
{{--                        @if($sg->id == $service->service_group_id)--}}
{{--                            <td>{{$sg->name}}</td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <td></td>--}}
{{--                @endif--}}

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
    @if(isset($dataForm))
        {{$services->appends($dataForm)->links()}}
    @else
        {{$services->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

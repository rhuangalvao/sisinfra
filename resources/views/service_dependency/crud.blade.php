@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service dependency</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service dependency'],['variavel'=>'service_dependency'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Service instance</th>
            <th>Service instance dep</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($service_dependencies as $service_dependency)
            <tr>
                @foreach($service_instance as $si)
                    @if($si->id == $service_dependency->service_instance_id_dep)
                        <td>{{$si->descr}}</td>
                    @endif
                @endforeach
                @foreach($service_instance as $si)
                    @if($si->id == $service_dependency->service_instance_id)
                        <td>{{$si->descr}}</td>
                    @endif
                @endforeach
                <td>
                    <a href="{{ route('service_dependency.edit',$service_dependency->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('service_dependency.destroy', $service_dependency->id)}}" method="post">
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
        {{$service_dependencies->appends($dataForm)->links()}}
    @else
        {{$service_dependencies->links()}}
    @endif
@endsection

@section('footer')
    @include('footer')
@endsection

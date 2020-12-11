@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service group</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service group'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('service_group.create')}}" class="btn btn-primary">New Service group</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Name</td>
            <td>Description</td>
            <td colspan = 2>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($service_groups as $service_group)
            <tr>
                <td>{{$service_group->name}}</td>
{{--                <td>{{$service_group->descr}}</td>--}}
                <td>
                    <button type="button" class="btn btn-link" data-container="body" data-toggle="popover" data-placement="right" data-content="{{$service_group->descr}}">
                        {{mb_strimwidth($service_group->descr, 0, 10, "...")}}
                    </button>
                </td>
                <td>
                    <a href="{{ route('service_group.edit',$service_group->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('service_group.destroy', $service_group->id)}}" method="post">
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
    {{$service_groups->links()}}
@endsection
@section('footer')
    @include('footer')
@endsection

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>

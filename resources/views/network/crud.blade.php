@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Network</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Network'],['variavel'=>'network'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Network type</th>
            <th>Name</th>
            <th>Description</th>
            <th>Address</th>
            <th>Enabled</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($networks as $network)
            <tr>
                <td>{{$network->type_name}}</td>
{{--                @foreach($network_type as $nt)--}}
{{--                    @if($nt->id == $network->network_type_id)--}}
{{--                        <td>{{$nt->name}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$network->name}}</td>
{{--                <td>{{$network->descr}}</td>--}}
                <td>
                    <button type="button" class="btn btn-link" data-container="body" data-toggle="popover" data-placement="right" data-content="{{$network->descr}}">
                        {{mb_strimwidth($network->descr, 0, 10, "...")}}
                    </button>
                </td>
                <td>{{$network->address}}</td>
                <td>{{$network->enabled}}</td>
                <td>
                    <a href="{{ route('network.edit',$network->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('network.destroy', $network->id)}}" method="post">
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
        {{$networks->appends($dataForm)->links()}}
    @else
        {{$networks->links()}}
    @endif
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

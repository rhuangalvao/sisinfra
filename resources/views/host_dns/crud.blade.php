@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host DNS</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host DNS'],['variavel'=>'host_dns'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Host</th>
            <th>Name</th>
            <th>Version</th>
            <th>Is main</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($host_dnss as $host_dns)
            <tr>
                <td>{{$host_dns->hostname}}</td>
{{--                @foreach($hosts as $h)--}}
{{--                    @if($h->id == $host_dns->host_id)--}}
{{--                        <td>{{$h->hostname}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$host_dns->name}}</td>
                <td>{{$host_dns->version}}</td>
                <td>{{$host_dns->is_main}}</td>
                <td>
                    <a href="{{ route('host_dns.edit',$host_dns->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host_dns.destroy', $host_dns->id)}}" method="post">
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
        {{$host_dnss->appends($dataForm)->links()}}
    @else
        {{$host_dnss->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

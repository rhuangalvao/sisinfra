@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Aux Vendor</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Aux Vendor'],['variavel'=>'aux_vendor'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Name</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($aux_vendors as $aux_vendor)
            <tr>
                <td>{{$aux_vendor->name}}</td>
                <td>
                    <a href="{{ route('aux_vendor.edit',$aux_vendor->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('aux_vendor.destroy', $aux_vendor->id)}}" method="post">
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
        {{$aux_vendors->appends($dataForm)->links()}}
    @else
        {{$aux_vendors->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

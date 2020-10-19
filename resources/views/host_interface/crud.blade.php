@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host_interface</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host_interface'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_interface.create')}}" class="btn btn-primary">Novo Host_interface</a>
    </div>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <td>Host</td>
            <td>ifname</td>
            <td>iftype</td>
            <td>ifspeed</td>
            <td>ifindex</td>
            <td>ifoperstatus</td>
            <td>ifalias</td>
            <td>portid</td>
            <td>is_mgmt</td>
            <td>is_mgmt</td>
            <td colspan = 2>Ações</td>
        </tr>
        </thead>
        <tbody>
        @foreach($host_interface as $host_interface)
            <tr>
                @foreach($host as $h)
                    @if($h->id == $host_interface->host_id)
                        <td>{{$h->hostname}}</td>
                    @endif
                @endforeach
                <td>{{$host_interface->ifname}}</td>
                <td>{{$host_interface->iftype}}</td>
                <td>{{$host_interface->ifspeed}}</td>
                <td>{{$host_interface->ifindex}}</td>
                <td>{{$host_interface->ifoperstatus}}</td>
                <td>{{$host_interface->ifalias}}</td>
                <td>{{$host_interface->portid}}</td>
                <td>{{$host_interface->is_mgmt}}</td>
                <td>{{$host_interface->discovery_protocol_id}}</td>
                <td>
                    <a href="{{ route('host_interface.edit',$host_interface->id)}}" class="btn btn-primary">Editar</a>
                </td>
                <td>
                    <form action="{{ route('host_interface.destroy', $host_interface->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Apagar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
@endsection


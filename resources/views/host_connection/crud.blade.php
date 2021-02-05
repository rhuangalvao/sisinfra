@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Host Connection</title>
</head>

@section('content')
{{--    @include('cabecalho',['tituloPagina'=>'Host Connection'],['variavel'=>'host_connection'])--}}

<div class="row">
    <div class="col-sm">
        <div style="text-align: center;"><img src="{{asset('/img/uepg.png')}}" alt="UEPG" height="100"></div>
    </div>
    <div class="col-sm text-center">
        <h1 class="display-4">Host Connection</h1>
    </div>
    <div class="col-sm">
        <div style="text-align: center;"><img src="{{asset('/img/nti.png')}}" alt="NTI" height="100"></div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm">
{{--            <a  href="{{ route($variavel.'.create')}}" class="btn btn-primary">New {{$tituloPagina}}</a>--}}
        </div>
        <div class="col-sm">
            <form method="post" action="{{ route('host_connection.search') }}">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <label>
                                Show
                                <select name="entradas">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                </select>
                                entries
                            </label>
                        </div>
                        <div class="col-sm">
                            <input type="text" class = "form-control " name="pesquisa" placeholder="">
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <br>
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Host interface a</th>
            <th>Host interface b</th>
            <th>Connection status</th>
            <th>Discovery protocol</th>
{{--            <th>Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($host_connections as $host_connection)
            <tr>
                <td>{{$host_connection->ifname}}</td>
{{--                @foreach($host_interfaces as $hi)--}}
{{--                    @if($hi->id == $host_connection->host_interface_id_a)--}}
{{--                        <td>{{$hi->ifname}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                @foreach($host_interfaces as $hi)
                    @if($hi->id == $host_connection->host_interface_id_b)
                        <td>{{$hi->ifname}}</td>
                    @endif
                @endforeach
                <td>{{$host_connection->connection_status}}</td>
                <td>{{$host_connection->name}}</td>
{{--                @if($host_connection->discovery_protocol_id != null)--}}
{{--                    @foreach($discovery_protocols as $dp)--}}
{{--                        @if($dp->id == $host_connection->discovery_protocol_id)--}}
{{--                            <td>{{$dp->name}}</td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <td></td>--}}
{{--                @endif--}}


{{--                <td>--}}
{{--                    <form action="{{ route('host_connection.destroy', $host_connection->id)}}" method="post">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button class="btn btn-danger" type="submit">Delete</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    @if(isset($dataForm))
        {{$host_connections->appends($dataForm)->links()}}
    @else
        {{$host_connections->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

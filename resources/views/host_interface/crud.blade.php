@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
@stack('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<head>
    <title>Host Interface</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host Interface'],['variavel'=>'host_interface'])
    <table id="interface-table" align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>Host</th>
            <th>Name</th>
            <th>Type</th>
            <th>Speed</th>
            <th>Index</th>
            <th>Oper status</th>
            <th>Alias</th>
            <th>Port ID</th>
            <th>Is mgmt</th>
            <th>Discovery protocol</th>
            <th>snmp_host_interface</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($host_interfaces as $host_interface)
            <tr>
                <td>{{$host_interface->hostname}}</td>
{{--                @foreach($host as $h)--}}
{{--                    @if($h->id == $host_interface->host_id)--}}
{{--                        <td>{{$h->hostname}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$host_interface->ifname}}</td>
                <td>{{$host_interface->iftype}}</td>
                <td>{{$host_interface->ifspeed}}</td>
                <td>{{$host_interface->ifindex}}</td>
                <td>{{$host_interface->ifoperstatus}}</td>
                <td>{{$host_interface->ifalias}}</td>
                <td>{{$host_interface->portid}}</td>
                <td>{{$host_interface->is_mgmt}}</td>
                <td>{{$host_interface->protocol_name}}</td>
{{--                @foreach($discovery_protocol as $dp)--}}
{{--                    @if($dp->id == $host_interface->discovery_protocol_id)--}}
{{--                        <td>{{$dp->name}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$host_interface->snmp_ifname}}</td>
{{--                @if($host_interface->snmp_host_interface_id != null)--}}
{{--                    @foreach($snmp_host_interface as $shi)--}}
{{--                        @if($shi->id == $host_interface->snmp_host_interface_id)--}}
{{--                            <td>{{$shi->ifname}}</td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <td></td>--}}
{{--                @endif--}}
                <td>
                    <a href="{{ route('host_interface.edit',$host_interface->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host_interface.destroy', $host_interface->id)}}" method="post">
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
        {{$host_interfaces->appends($dataForm)->links()}}
    @else
        {{$host_interfaces->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

{{--<script>--}}
{{--    var table = $('#interface-table').DataTable({--}}
{{--        destroy: true,--}}
{{--        lengthMenu: [ 5, 10, 15, 25, 50, 100, 'Todas' ],--}}
{{--        responsive: true,--}}
{{--        processing: true,--}}
{{--        serverSide: true,--}}
{{--        ajax: "{!! route('host_interface.crud') !!}",--}}
{{--        columns: [--}}
{{--            {data: 'host_id', name: 'host_id'},--}}
{{--            {data: 'ifname', name: 'ifname'},--}}
{{--            {data: 'iftype', name: 'iftype'},--}}
{{--            {data: 'ifspeed', name: 'ifspeed'},--}}
{{--            {data: 'ifindex', name: 'ifindex'},--}}
{{--            {data: 'ifoperstatus', name: 'ifoperstatus'},--}}
{{--            {data: 'ifalias', name: 'ifalias'},--}}
{{--            {data: 'portid', name: 'portid'},--}}
{{--            {data: 'is_mgmt', name: 'is_mgmt'},--}}
{{--            {data: 'discovery_protocol_id', name: 'discovery_protocol_id'},--}}
{{--            {data: 'snmp_host_interface_id', name: 'snmp_host_interface_id'},--}}
{{--            {--}}
{{--                "data": "action",--}}
{{--                "render": function(data, type, row, meta){--}}
{{--                    return '<a href="'+ $('link[rel="base"]').attr('href') + '/editar/' + row.id +'" class="btn btn-xs btn-info" title="Editar Pessoa"> <i class="fa fa-edit"></i></a> <a href="'+ $('link[rel="base"]').attr('href') + '/excluir/' + row.id +'" id="person-'+ row.id +'" class="btn btn-xs btn-danger" data-toggle="confirmation" data-btn-ok-label="Sim" data-btn-ok-class="btn-success" data-btn-ok-icon-class="material-icons" data-btn-ok-icon-content="" data-btn-cancel-label="Não" data-btn-cancel-class="btn-danger" data-btn-cancel-icon-class="material-icons" data-btn-cancel-icon-content="" data-title="Tem certeza que deseja excluir o cadastro de '+ row.name +'?" data-content="Esta ação não poderá ser desfeita." title="Excluir Pessoa"> <i class="fa fa-trash"></i></a>';--}}
{{--                }--}}
{{--            }--}}
{{--        ],--}}
{{--    });--}}
{{--</script>--}}

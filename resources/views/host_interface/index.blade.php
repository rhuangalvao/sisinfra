@extends('adminlte::page')
<head>
    <title>Host Interface</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Host Interface'])
    <div class="container offset-sm-2">
        <a style="margin: 19px;" href="{{ route('host_interface.create')}}" class="btn btn-primary">New Host Interface</a>
    </div>
    {!! $dataTable->table() !!}
    {!! $dataTable->scripts() !!}
@endsection
@section('footer')
    @include('footer')
@endsection

{{--@extends('adminlte::page')--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Host Interface</title>--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />--}}
{{--    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">--}}
{{--    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}
{{--</head>--}}
{{--@section('content')--}}
{{--<body>--}}

{{--<div class="container">--}}
{{--    @include('cabecalho',['tituloPagina'=>'Host Interface'])--}}
{{--    <div class="container offset-sm-2">--}}
{{--        <a style="margin: 19px;" href="{{ route('host_interface.create')}}" class="btn btn-primary">New Host Interface</a>--}}
{{--    </div>--}}

{{--    <table class="table table-bordered data-table" >--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <td>Host</td>--}}
{{--            <td>Name</td>--}}
{{--            <td>Type</td>--}}
{{--            <td>Speed</td>--}}
{{--            <td>Index</td>--}}
{{--            <td>Oper status</td>--}}
{{--            <td>Alias</td>--}}
{{--            <td>Port ID</td>--}}
{{--            <td>Is mgmt</td>--}}
{{--            <td>Discovery protocol</td>--}}
{{--            <td>snmp_host_interface</td>--}}
{{--            <td colspan = 2>Actions</td>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--    </table>--}}
{{--</div>--}}
{{--</body>--}}
{{--@endsection--}}
{{--<script type="text/javascript">--}}

{{--    $(document).ready(function () {--}}

{{--        var table = $('.data-table').DataTable({--}}
{{--            processing: true,--}}
{{--            serverSide: true,--}}
{{--            ajax: "{{ route('host_interface.index') }}",--}}
{{--            columns: [--}}
{{--                {data: 'id', name: 'id'},--}}
{{--                {data: 'host_id', name: 'host_id'},--}}
{{--                {data: 'ifname', name: 'ifname'},--}}
{{--                {data: 'iftype', name: 'iftype'},--}}
{{--                {data: 'ifspeed', name: 'ifspeed'},--}}
{{--                {data: 'ifindex', name: 'ifindex'},--}}
{{--                {data: 'ifoperstatus', name: 'ifoperstatus'},--}}
{{--                {data: 'ifalias', name: 'ifalias'},--}}
{{--                {data: 'portid', name: 'portid'},--}}
{{--                {data: 'is_mgmt', name: 'is_mgmt'},--}}
{{--                {data: 'discovery_protocol_id', name: 'discovery_protocol_id'},--}}
{{--                {data: 'snmp_host_interface_id', name: 'snmp_host_interface_id'},--}}
{{--                {data: 'created_at', name: 'created_at'},--}}
{{--                {data: 'updated_at', name: 'updated_at'},--}}
{{--                {data: 'action', name: 'action', orderable: false, searchable: false},--}}
{{--            ]--}}
{{--        });--}}

{{--        /* Delete customer */--}}
{{--        $('body').on('click', '#delete-user', function () {--}}
{{--            var user_id = $(this).data("id");--}}
{{--            var token = $("meta[name='csrf-token']").attr("content");--}}
{{--            confirm("Are You sure want to delete !");--}}

{{--            $.ajax({--}}
{{--                type: "DELETE",--}}
{{--                url: "http://localhost/laravelpro/public/users/"+user_id,--}}
{{--                data: {--}}
{{--                    "id": user_id,--}}
{{--                    "_token": token,--}}
{{--                },--}}
{{--                success: function (data) {--}}

{{--//$('#msg').html('Customer entry deleted successfully');--}}
{{--//$("#customer_id_" + user_id).remove();--}}
{{--                    table.ajax.reload();--}}
{{--                },--}}
{{--                error: function (data) {--}}
{{--                    console.log('Error:', data);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--    });--}}

{{--</script>--}}
{{--</html>--}}

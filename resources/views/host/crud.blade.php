@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<style type="text/css">
    body{
        overflow-x:hidden;
    }
</style>
<head>

    <title>Host</title>
</head>
@section('content')
        @include('cabecalho',['tituloPagina'=>'Host'],['variavel'=>'host'])
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm">--}}
{{--                <a  href="{{ route('host.create')}}" class="btn btn-primary">New Host</a>--}}
{{--            </div>--}}
{{--            <div class="col-sm">--}}
{{--                <form method="post" action="{{ route('host.search') }}">--}}
{{--                    @csrf--}}
{{--                    <div class="container">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm">--}}
{{--                                <label>--}}
{{--                                    Show--}}
{{--                                    <select name="entradas">--}}
{{--                                        <option value="10">10</option>--}}
{{--                                        <option value="25">25</option>--}}
{{--                                        <option value="50">50</option>--}}
{{--                                    </select>--}}
{{--                                    entries--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm">--}}
{{--                                <input type="text" class = "form-control " name="pesquisa" placeholder="Search Host">--}}
{{--                            </div>--}}
{{--                            <div class="col-sm">--}}
{{--                                <button type="submit" class="btn btn-primary">Search</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="table-responsive">
    <table id="tabelafiltro" align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
            <th>OS</th>
            <th>Type</th>
            <th>Status</th>
            <th>TAG</th>
            <th>Hostname</th>
            <th>Domain suffix</th>
            <th>Description</th>
            <th>Obs</th>
            <th>Chassis id</th>
            <th>Monitoring</th>
            <th>Enabled</th>
            <th>Serial Number</th>
            <th>Vendor</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hosts as $host)
            <tr>
                <td>{{$host->os_name}}</td>
{{--                @foreach($operating_systems as $os)--}}
{{--                    @if($os->id == $host->os_id)--}}
{{--                        <td>{{$os->name}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$host->type_name}}</td>
{{--                @foreach($host_types as $ht)--}}
{{--                    @if($ht->id == $host->host_type_id)--}}
{{--                        <td>{{$ht->name}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$host->status}}</td>
{{--                @foreach($host_status as $hs)--}}
{{--                    @if($hs->id == $host->status_id)--}}
{{--                        <td>{{$hs->status}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$host->tag}}</td>
                <td>{{$host->hostname}}</td>
                <td>{{$host->domain_suffix}}</td>
{{--                <td>{{$host->descr}}</td>--}}
                <td>
                    <button type="button" class="btn btn-link" data-container="body" data-toggle="popover" data-placement="right" data-content="{{$host->descr}}">
                        {{mb_strimwidth($host->descr, 0, 10, "...")}}
                    </button>
                </td>
                <td>{{$host->obs}}</td>
                <td>{{$host->chassis_id}}</td>
                <td>{{$host->monitoring}}</td>
                <td>{{$host->enabled}}</td>
                <td>{{$host->serial_number}}</td>
                <td>{{$host->vendor_name}}</td>
{{--                @if($host->aux_vendor_id != null)--}}
{{--                    @foreach($aux_vendors as $av)--}}
{{--                        @if($av->id == $host->aux_vendor_id)--}}
{{--                            <td>{{$av->name}}</td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <td></td>--}}
{{--                @endif--}}
                <td>
                    <a href="{{ route('host.edit',$host->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('host.destroy', $host->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <br/>
    @if(isset($dataForm))
    {{$hosts->appends($dataForm)->links()}}
    @else
        {{$hosts->links()}}
    @endif
@endsection
@section('footer')
    @include('footer')
@endsection

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    });
</script>

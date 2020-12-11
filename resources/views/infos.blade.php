@extends('adminlte::page')
<head>
    <title>Host</title>
</head>
@section('content')
    @include('cabecalho',['tituloPagina'=>'Host'])
    <br>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class ="card">
                <div class="card-body">
                    @foreach($hosts as $host)
                        @if($host->id == $infos)
                            <label>Operating System: </label>
                            @foreach($operating_system as $os)
                                @if($os->id == $host->os_id)
                                    <td>{{$os->name}}</td>
                                @endif
                            @endforeach
                            <br><label>Host Type: </label>
                            @foreach($host_type as $ht)
                                @if($ht->id == $host->host_type_id)
                                    <td>{{$ht->name}}</td>
                                @endif
                            @endforeach
                            <br><label>Host Status: </label>
                            @foreach($host_status as $hs)
                                @if($hs->id == $host->status_id)
                                    <td>{{$hs->status}}</td>
                                @endif
                            @endforeach
                            <br><label>TAG: </label>
                            <td>{{$host->tag}}</td>
                            <br><label>Name: </label>
                            <td>{{$host->hostname}}</td>
                            <br><label>Domain Suffix: </label>
                            <td>{{$host->domain_suffix}}</td>
                            <br><label>Description: </label>
                            <td>{{$host->descr}}</td>
                            <br><label>Observations: </label>
                            <td>{{$host->obs}}</td>
                            <br><label>Chassis: </label>
                            <td>{{$host->chassis_id}}</td>
                            <br><label>Monitoring: </label>
                            <td>{{$host->monitoring}}</td>
                            <br><label>Enabled: </label>
                            <td>{{$host->enabled}}</td>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br/>
@endsection
@section('footer')
    @include('footer')
@endsection

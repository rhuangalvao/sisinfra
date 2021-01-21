@extends('adminlte::page')
{{--<script src="{{asset('js/jquery-3.4.1.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">--}}
{{--<script src="{{asset('js/popper.min.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.js')}}"></script>--}}
<head>
    <title>Service instance</title>
</head>

@section('content')
    @include('cabecalho',['tituloPagina'=>'Service instance'],['variavel'=>'service_instance'])
    <table align="center" class="table table-striped table-active table-sm table-bordered col-sm-8">
        <thead>
        <tr>
{{--            <th>ID</th>--}}
            <th>Host</th>
            <th>Service</th>
            <th>Host IP</th>
            <th>Host DNS</th>
            <th>Description</th>
            <th>Password</th>
            <th>Monitoring</th>
            <th colspan = 2>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($service_instances as $service_instance)
            <tr>
{{--                <td>{{$service_instance->id}}</td>--}}
                <td>{{$service_instance->hostname}}</td>
{{--                @foreach($host as $h)--}}
{{--                    @if($h->id == $service_instance->host_id)--}}
{{--                        <td>{{$h->hostname}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$service_instance->service_name}}</td>
{{--                @foreach($service as $s)--}}
{{--                    @if($s->id == $service_instance->service_id)--}}
{{--                        <td>{{$s->name}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$service_instance->ip_address}}</td>
                @if($service_instance->host_ip_id != null)
                    <td>{{$service_instance->ip_address}}</td>
{{--                    @foreach($host_ip as $hi)--}}
{{--                        @if($hi->id == $service_instance->host_ip_id)--}}
{{--                            <td>{{$hi->ip_address}}</td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                        <td></td>--}}
                @else
                    <td>{{$service_instance->dns_name}}</td>
{{--                    @foreach($host_dns as $hd)--}}
{{--                        @if($hd->id == $service_instance->host_dns_id)--}}
{{--                            <td>{{$hd->name}}</td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                @endif
{{--                @foreach($host_ip as $hi)--}}
{{--                    @if($hi->id == $service_instance->host_ip_id)--}}
{{--                        <td>{{$hi->ip_address}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                @foreach($host_dns as $hd)--}}
{{--                    @if($hd->id == $service_instance->host_dns_id)--}}
{{--                        <td>{{$hd->name}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                <td>{{$service_instance->descr}}</td>--}}
                <td>
                    <button type="button" class="btn btn-link" data-container="body" data-toggle="popover" data-placement="right" data-content="{{$service_instance->descr}}">
                        {{mb_strimwidth($service_instance->descr, 0, 10, "...")}}
                    </button>
                </td>
                <td>{{$service_instance->password_name}}</td>
{{--                @foreach($password as $pw)--}}
{{--                    @if($pw->id == $service_instance->password_id)--}}
{{--                        <td>{{$pw->name}}</td>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
                <td>{{$service_instance->monitoring}}</td>
                <td>
                    <a href="{{ route('service_instance.edit',$service_instance->id)}}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('service_instance.destroy', $service_instance->id)}}" method="post">
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
        {{$service_instances->appends($dataForm)->links()}}
    @else
        {{$service_instances->links()}}
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


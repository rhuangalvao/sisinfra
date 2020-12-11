@extends('adminlte::page')

<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<head>
    <title>Host map</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit Host map</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <div class ="card">
                <div class="card-body">
                    <form method="post" action="{{ route('host_map.update', $host_map->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="host_id">Host: </label>
                            <select id="host_id" name="host_id" class="select2ex form-control">
                                @foreach($host as $h)
                                    @if($host_map->host_id == $h->id)
                                        <option value="{{ $host_map->host_id }}" selected>{{ $h->hostname }}</option>
                                    @endif
                                @endforeach
                                @foreach($host as $h)
                                    <option value={{$h->id}}> {{$h->hostname}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="snmp_host_id">snmp_host: </label>
                            <select id="snmp_host_id" name="snmp_host_id" class="select2ex form-control">
                                @if($host_map->snmp_host_id!=null)
                                    @foreach($snmp_host as $sh)
                                        @if($host_map->snmp_host_id == $sh->id)
                                            <option value="{{ $host_map->snmp_host_id }}" selected>{{ $sh->hostname }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="" selected></option>
                                @endif
                                @foreach($snmp_host as $sh)
                                    <option value={{$sh->id}}> {{$sh->hostname}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="snmp_host_remote_id">snmp_host_remote: </label>
                            <select id="snmp_host_remote_id" name="snmp_host_remote_id" class="select2ex form-control">
                                @if($host_map->snmp_host_remote_id!=null)
                                @foreach($snmp_host as $sh)
                                    @if($host_map->snmp_host_remote_id == $sh->id)
                                        <option value="{{ $host_map->snmp_host_remote_id }}" selected>{{ $sh->hostname }}</option>
                                    @endif
                                @endforeach
                                @else
                                    <option value="" selected></option>
                                @endif
                                @foreach($snmp_host as $sh)
                                    <option value={{$sh->id}}> {{$sh->hostname}} </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Edit</button>
                        <form>
                            <input type="button" class="btn btn-danger" value="Cancel" onclick="history.back()">
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('footer')
@endsection

@extends('adminlte::page')

<head>
    <title>Host map</title>
</head>
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add Host map</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <div class ="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('host_map.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="host_id">Host: </label>
                                <select id="host_id" name="host_id" class="select2ex form-control">
                                    <option disabled value="" selected>Host name</option>
                                    @foreach($host as $h)
                                        <option value={{$h->id}}> {{$h->hostname}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="snmp_host_id">snmp_host: </label>
                                <select id="snmp_host_id" name="snmp_host_id" class="select2ex form-control">
                                    <option disabled value="" selected>snmp_host name</option>
                                    @foreach($snmp_host as $sh)
                                        <option value={{$sh->id}}> {{$sh->hostname}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="snmp_host_remote_id">snmp_host_remote: </label>
                                <select id="snmp_host_remote_id" name="snmp_host_remote_id" class="select2ex form-control">
                                    <option disabled value="" selected>snmp_host_remote name</option>
                                    @foreach($snmp_host as $sh)
                                        <option value={{$sh->id}}> {{$sh->hostname}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Host map</button>
                            <form>
                                <input type="button" class="btn btn-danger" value="Cancel" onclick="history.back()">
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('footer')
@endsection
